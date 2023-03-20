<!DOCTYPE html>
<html lang="en">
<head>
    <!--
    Team: Jimma Shanko, Tram-Anh Ngo, Dominic Cummings, Brittany Schaefer
    Project: Fitavate
    Page: User Notifications
    Date Created: 2-8-22
    Date Updated: 2-8-22
    By: Brittany Schaefer
    -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel= "styleSheet" href="styleSheet.css">
    <title>Notifications</title>
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
            <h1 class="PageHeader">Notifications</h1>
            <form>
                <button type='submit'>Something new happened</button><input type="text" placeholder="Date">
                <br><br>
                <button type='submit'>Click on this thing</button>
                <br><br>
                <button type='submit'>Maybe you care about this</button>
                <br><br>
                <button type='submit'>Had to make you look</button>
                <br>
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
