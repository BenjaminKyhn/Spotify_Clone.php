<?php
$songQuery = mysqli_query($conn, "SELECT id FROM songs ORDER BY RAND() LIMIT 10");
$resultArray = array();

while ($row = mysqli_fetch_array($songQuery)) {
    array_push($resultArray, $row['id']);
}

$jsonArray = json_encode($resultArray);
?>

<script>

    currentPlaylist = <?php echo $jsonArray; ?>;

    $(document).ready(function () { // Waits for the page to be ready (everything loaded)
        currentPlaylist = <?php echo $jsonArray; ?>;
        audioElement = new Audio();
        setTrack(currentPlaylist[0], currentPlaylist, false);
    });

    function setTrack(trackId, newPlaylist, play) {
        audioElement.setTrack("assets/music/bensound-clearday.mp3");

        if (play){
            audioElement.play();
        }
    }

    function playSong(){
        $(".controlButton.play").hide();
        $(".controlButton.pause").show();
        audioElement.play();
    }

    function pauseSong(){
        $(".controlButton.play").show();
        $(".controlButton.pause").hide();
        audioElement.pause();
    }

</script>

<div id="nowPlayingBar">
    <div id="nowPlayingLeft">
        <div class="content">
                <span class="albumLink">
                    <img class="albumArtwork"
                         src="https://image.freepik.com/free-vector/pack-colorful-square-emoticons_23-2147589525.jpg">
                </span>

            <div class="trackInfo">
                    <span class="trackName">
                        <span>Happy Birthday</span>
                    </span>

                <span class="artistName">
                        <span>Benny</span>
                    </span>
            </div>

        </div>
    </div>

    <div id="nowPlayingCenter">
        <div class="content playerControls">
            <div class="buttons">
                <button class="controlButton shuffle" title="Shuffle Button">
                    <img src="assets/images/icons/shuffle.png" alt="Shuffle">
                </button>

                <button class="controlButton previous" title="Previous Button">
                    <img src="assets/images/icons/previous.png" alt="Previous">
                </button>

                <button class="controlButton play" title="Play Button" onclick="playSong()">
                    <img src="assets/images/icons/play.png" alt="Play">
                </button>

                <button class="controlButton pause" title="Pause Button" style="display: none;" onclick="pauseSong()">
                    <img src="assets/images/icons/pause.png" alt="Pause">
                </button>

                <button class="controlButton next" title="Next Button">
                    <img src="assets/images/icons/next.png" alt="Next">
                </button>

                <button class="controlButton repeat" title="Repeat Button">
                    <img src="assets/images/icons/repeat.png" alt="Repeat">
                </button>
            </div>

            <div class="playbackBar">
                <span class="progressTime current">0.00</span>

                <div class="progressBar">
                    <div class="progressBarBg">
                        <div class="progress">
                        </div>
                    </div>
                </div>

                <span class="progressTime remaining">0.00</span>
            </div>

        </div>
    </div>

    <div id="nowPlayingRight">
        <div class="volumeBar">
            <button class="controlButton volume" title="Volume Button">
                <img src="assets/images/icons/volume.png" alt="Volume">
            </button>

            <div class="progressBar">
                <div class="progressBarBg">
                    <div class="progress">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>