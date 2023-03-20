!DOCTYPE html>
<html lang="en">
<head>
    <!--
    Team: Jimma Shanko, Tram-Anh Ngo, Dominic Cummings, Brittany Schaefer
    Project: Fitavate
    Page: Fitavator Profile
    Date Created: 2-8-22
    Date Updated: 2-8-22
    By: Brittany Schaefer
    -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel= "styleSheet" href="styleSheet.css">
    <title>Fitavate</title>
</head>
<body>
    <header>
        <?php
            include("header.php");
        ?>
    </header>
    <div class="pageContainer">
        <div class="Column left">
            <?php
                include("leftNavBar.php");
            ?>
        </div>
        <!--Jimma Shanko-->
        <div class="Column middle">
            <h1 class="PageHeader">Home</h1>

        </div>
        <div class="Column right">
            <?php
                include("rightNavBar.php");
            ?>
        </div>
    </div>
    <footer>
        <?php
            include("footer.php");
        ?>
    </footer>
</body>
</html>
