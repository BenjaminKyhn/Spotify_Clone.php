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
    <input type="text" class="searchInput" value="<?php echo $term; ?>" placeholder="Start typing..." onfocus="this.value = this.value">

</div>

<script>

    $(".searchInput").focus();

    $(function() {
        var timer;

        $(".searchInput").keyup(function (){
            clearTimeout(timer); //Resets the timer every time you type something

            timer = setTimeout(function(){
                var value = $(".searchInput").val();
                openPage("search.php?term=" + value);  //TODO: userLoggedIn = undefined is appended to term (it should not be)
            }, 2000);
        });
    });

</script>