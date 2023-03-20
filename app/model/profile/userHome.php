<!DOCTYPE html>
<html lang="en">
<head>
    <!--
    Team: Jimma Shanko, Tram-Anh Ngo, Dominic Cummings, Brittany Schaefer
    Project: Fitavate
    Page: User Home Page
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
        <div class="Column middle">
            <h1 class="PageHeader">Home</h1>
            <form>
                <input type="text" placeholder="Fitavator Display Name"><button type='submit'>+Follow</button>
                <br>
                <br>
                <input type="text" placeholder=" "><button type='submit'>Comment</button>
                <br>
                <br>
                <input type="text" placeholder="Fitavator Friend"><button type='submit'>Following</button>
            </form>
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
