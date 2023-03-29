<?php
    session_start();
    $usrImageEncoded = $_SESSION['usrImage'];
    if ($_SESSION == "landscape") {
        // Embed the base64-encoded string in an HTML img tag
        $usrImage ='<div class="circular--landscape"><img src="data:image/jpeg;base64,' . $usrImageEncoded . '" alt="Image" /></div>';
    } else {
        $usrImage ='<div class="circular--portrait"><img src="data:image/jpeg;base64,' . $usrImageEncoded . '" alt="Image" /></div>';
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <!--
    Team: Jimma Shanko, Tram-Anh Ngo, Dominic Cummings, Brittany Schaefer
    Project: Fitavate
    Page: User Home Page
    Date Created: 2-8-22
    Date Updated: 3-6-22
    By: Brittany Schaefer
    -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <link rel= "styleSheet" href="styleSheet.css">
    <title>Fitavate</title>
</head>
<body>
    <div class="container-fluid p-0 m-0">
        <div class="row headerContainer">
            <div class="col-md-3 headerContentLeft">
                <img class="img-fluid" src="graphic/logo.png" alt="Logo">
            </div>
            <div class="col-md-8 headerContentMiddle">
                <img class="img-fluid" src="graphic/fitavate.png" alt="Fitavate">
            </div>
        </div>
        <div class="row pageContainer">
            <nav class="col-md-2 navbar leftNavigationBar">
                <ul>
                    <li class="navbar-brand"><a class="nav-link" href="?page=profile/profile"><?php echo $usrImage ?></a></li>
                    <li class="navbar-nav"><a class="nav-link" href="?page=home">Home</a></li>
                    <li class="navbar-nav"><a class="nav-link" href="?page=notifications/notifications">Notifications</a></li>
                    <li class="navbar-nav"><a class="nav-link" href="?page=fitines/fitine">FitTines</a></li>
                    <li class="navbar-nav"><a class="nav-link" href="?page=followers/followers">Followers</a></li>
                    <li class="navbar-nav"><a class="nav-link" href="?page=following/following">Following</a></li>
                    <li class="navbar-nav"><a class="nav-link" href="?page=login/logout">Logout</a></li>
                </ul>
            </nav>
            <div class="col-md-8 middleContent">
                <?php
                    include($main_content);
                ?>
            </div>
            <div class="col-md-2 rightNavigationBar">
                <div class="rightLogo">
                    <img src="graphic/logo.png" alt="logo">
                </div>
            </div>
        </div>
        <div class="row footer">
            <p>CopyRight Fitavate 2023</p>
        </div>
    </div>

</body>
</html>
