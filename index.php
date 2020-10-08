<?php include("includes/header.php"); ?>

    <h1 class="pageHeadingBig">You might also like</h1>

    <div class="griViewContainer">

        <?php
        $albumQuery = mysqli_query($conn, "SELECT * FROM albums ORDER BY RAND() LIMIT 10");

        while ($row = mysqli_fetch_array($albumQuery)) {
            echo "<div class='gridViewItem'>

                    <img src='" . $row['artworkPath'] . "'>
                    
                    <div class='gridViewInfo'>"
                        . $row['title'] .
                    "</div>

                </div>";
        }
        ?>

    </div>

<?php include("includes/footer.php"); ?>