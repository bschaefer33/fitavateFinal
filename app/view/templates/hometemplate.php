<?php
    session_start();
    $usrImage = $_SESSION['usrImage'];
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
    <div class="container-fluid p-0 m-0 no-gutters siteContainer">
        <div class="row headerContainer">
            <div class="col col-md-2 headerContentLeft">
                <img class="img-fluid" src="graphic/logo.png" alt="Logo">
            </div>
            <div class="col col-md-8 headerContentMiddle">
                <img class="img-fluid" src="graphic/fitavate.png" alt="Fitavate">
            </div>
        </div>
        <div class="row no-gutters pageContainer">
            <div class="col col-sm-2 leftNavigationBar">
                <a class="container profImg" href="?page=profile/profile"><?php echo $usrImage ?></a>
                <nav class="navbar">
                    <ul>
                        <li class="navbar-nav"><a class="nav-link" href="?page=home">Home</a></li>
                        <li class="navbar-nav"><a class="nav-link" href="?page=notifications/notifications">Notifications</a></li>
                        <li class="navbar-nav"><a class="nav-link" href="?page=fitines/fitine">FitTines</a></li>
                        <li class="navbar-nav"><a class="nav-link" href="?page=followers/followers">Followers</a></li>
                        <li class="navbar-nav"><a class="nav-link" href="?page=following/following">Following</a></li>
                        <li class="navbar-nav"><a class="nav-link" href="?page=login/logout">Logout</a></li>
                    </ul>
                </nav>
            </div>
            <div class="col col-sm-7 middleContent">
                <?php
                    include($main_content);
                ?>
            </div>
            <div class="col rightNavigationBar">
                <div class="container imgHolder">
                    <img src="graphic/logo.png" alt="logo">
                </div>
            </div>
        </div>
        <div class="row justify-content-center footContainer">
            <h5 class="col align-self-center">CopyRight Fitavate 2023</h5>
        </div>
    </div>

</body>
</html>
