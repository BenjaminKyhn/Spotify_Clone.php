<?php
include("includes/includedFiles.php");

if (isset($_GET['id'])) {
    $artistId = $_GET['id'];
} else {
    header("Location: index.php"); //should show an error page saying the artist could not be found
}

$artist = new Artist($conn, $artistId);
?>

<div class="entityInfo">

    <div class="centerSection">

        <div class="artistInfo">

            <h1 class="artistName"><?php echo $artist->getName(); ?></h1>

            <div class="headerButtons">

                <button class="button">Play</button>

            </div>

        </div>

    </div>

</div>
