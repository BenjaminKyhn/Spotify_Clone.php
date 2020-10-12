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
        updateVolumeProgressBar(audioElement.audio);

        // Prevent controls from highlighting on mouse activity
        $("#nowPlayingBarContainer").on("mousedown touchstart mousemove touchmove", function (e) {
            e.preventDefault();
        });

        $(".playbackBar .progressBar").mousedown(function () {
            mousePressed = true;
        });

        $(".playbackBar .progressBar").mousemove(function (e) {
            if (mousePressed){
                // Set time of song, depending on the position of the mouse
                timeFromOffset(e, this);
            }
        });

        $(".playbackBar .progressBar").mouseup(function(e) {
            timeFromOffset(e, this);
        });

        $(".volumeBar .progressBar").mousedown(function () {
            mousePressed = true;
        });

        $(".volumeBar .progressBar").mousemove(function (e) {
            if (mousePressed){
                var percentage = e.offsetX / $(this).width();

                if (percentage >= 0 && percentage <= 1){
                    audioElement.audio.volume = percentage;
                }
            }
        });

        $(".volumeBar .progressBar").mouseup(function(e) {
            var percentage = e.offsetX / $(this).width();

            if (percentage >= 0 && percentage <= 1){
                audioElement.audio.volume = percentage;
            }
        });

        $(document).mouseup(function () {
            mousePressed = false;
        })
    });

    function timeFromOffset(mouse, progressBar){
        var percentage = mouse.offsetX / $(progressBar).width() * 100;
        var seconds = audioElement.audio.duration * (percentage / 100);
        audioElement.setTime(seconds);
    }

    function nextSong(){
        if (repeat){
            audioElement.setTime(0);
            playSong();
            return;
        }

        if (currentIndex === currentPlaylist.length - 1){
            currentIndex = 0;
        }
        else {
            currentIndex++;
        }

        var trackToPlay = currentPlaylist[currentIndex];
        setTrack(trackToPlay, currentPlaylist, true);
    }

    function setTrack(trackId, newPlaylist, play) {

        currentIndex = currentPlaylist.indexOf(trackId);
        pauseSong();

        $.post("includes/handlers/ajax/getSongjson.php", {songId: trackId}, function(data){
            var track = JSON.parse(data);
            $(".trackName span").text(track.title);

            $.post("includes/handlers/ajax/getArtistjson.php", {artistId: track.artist}, function(data){
                var artist = JSON.parse(data);
                $(".artistName span").text(artist.name);
            });

            $.post("includes/handlers/ajax/getAlbumjson.php", {albumId: track.album}, function(data){
                var album = JSON.parse(data);
                $(".albumLink img").attr("src", album.artworkPath);
            });

            audioElement.setTrack(track);
            playSong();
        });

        if (play === true){
            audioElement.play();
        }
    }

    function playSong(){

        if (audioElement.audio.currentTime === 0){
            $.post("includes/handlers/ajax/updatePlays.php", { songId: audioElement.currentlyPlaying.id});
        }

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
                         src="">
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

                <button class="controlButton next" title="Next Button" onclick="nextSong()">
                    <img src="assets/images/icons/next.png" alt="Next">
                </button>

                <button class="controlButton repeat" title="Repeat Button">
                    <img src="assets/images/icons/repeat.png" alt="Repeat">
                </button>
            </div>

            <div class="playbackBar">
                <span class="progressTime current">0:00</span>

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