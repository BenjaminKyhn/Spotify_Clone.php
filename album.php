<?php include("includes/header.php");

if (isset($_GET['id'])) {
    $albumId = $_GET['id'];
} else {
    header("Location: index.php");
}

$albumQuery = mysqli_query($conn, "SELECT * FROM albums WHERE id='$albumId'");
$album = mysqli_fetch_array($albumQuery);

$artist = new Artist($conn, $album['artist']);

echo $artist->getName();

?>

<?php include("includes/footer.php"); ?>
