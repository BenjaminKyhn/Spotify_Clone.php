<?php
include("includes/includedFiles.php");

if (isset($_GET['term'])){
    $term = urldecode($_GET['term']);
}
else {
    $term = "";
}
?>

<div class="searchContainer">

    <h4>Search for an artist, album or song</h4>
    <input type="text" class="searchInput" value="<?php echo $term; ?>" placeholder="Start typing..." onfocus="this.value = this.value"> <!-- cursor still hops to the start of the input field even though we used this "hack" -->

</div>

<script>

    $(".searchInput").focus();

    $(function() {
        var timer;

        $(".searchInput").keyup(function (){
            clearTimeout(timer); //Resets the timer every time you type something

            timer = setTimeout(function(){
                var val = $(".searchInput").val();
                openPage("search.php?term=" + val);
            }, 2000);
        });
    });

</script>

<div class="tracklistContainer borderBottom">

    <h2>SONGS</h2>

    <ul class="tracklist">

        <?php
        $songsQuery = mysqli_query($conn, "SELECT id FROM songs WHERE title LIKE '$term%' LIMIT 10"); //The % symbol means that results will be returned even if there are other characters after $term

        if (mysqli_num_rows($songsQuery) == 0){
            echo "<span class='noResults'>No songs found matching " . $term . "</span>";
        }

        $songIdArray = array();

        $i = 1;
        while ($row = mysqli_fetch_array($songsQuery)){

            if($i > 15){
                break;
            }

            array_push($songIdArray, $row['id']);

            $albumSong = new Song($conn, $row['id']);
            $albumArtist = $albumSong->getArtist();

            echo "<li class='tracklistRow'>
                        <div class='trackCount'>
                            <img class='play' src='assets/images/icons/play-white.png' onclick='setTrack(\"" . $albumSong->getId() ."\", tempPlaylist, true)'>
                            <span class='trackNumber'>$i</span>
                        </div>
                        
                        <div class='trackInfo'>
                            <span class='trackName'>" . $albumSong->getTitle() . "</span>
                            <span class='artistName'>". $albumArtist->getName() . "</span>
                        </div>
                        
                        <div class='trackOptions'>
                            <img class='optionsButton' src='assets/images/icons/more.png'>
                        </div>
                        
                        <div class='trackDuration'>
                            <span class='duration'>". $albumSong->getDuration() . "</span>
                        </div>
                    </li>";

            $i++;
        }
        ?>

        <script>
            var tempSongIds = '<?php echo json_encode($songIdArray); ?>';
            tempPlaylist = JSON.parse(tempSongIds);
        </script>

    </ul>
</div>

<div class="artistContainer borderBottom">

    <h2>ARTISTS</h2>

    <?php
    $artistQuery = mysqli_query($conn, "SELECT id FROM artists WHERE name LIKE '$term%' LIMIT 10");

    if(mysqli_num_rows($artistQuery) == 0){
        echo "<span class='noResults'>No artists found matching " . $term . "</span>";
    }

    while($row = mysqli_fetch_array($artistQuery)){
        $artistFound = new Artist($conn, $row['id']);

        echo "<div class='searchResultRow'>
                <div class='artistName'>
                    <span role='link' tabindex='0' onclick='openPage(\"artist.php?id=" . $artistFound->getId() ."\")'>
                        "
                        . $artistFound->getName() .
                        "
                    </span>
                </div>
            </div>";
    }
    ?>

</div>