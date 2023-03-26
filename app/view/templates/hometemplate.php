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
        <div class="container-fluid p-0 m-0">
            <div id="headerContainer">
                <div id="headerContentLeft">
                    <img src="graphic/logo.png" alt="Logo">
                </div>
                <div id="headerContentMiddle">
                    <img src="graphic/fitavate.png" alt="Fitavate">
                </div>
            </div>
        </div>
    <div class="pageContainer">
        <nav class="navebar bg-light">
            <div class= "Column left">
                <div class="leftNavigationBar">
                    <ul>
                        <li class="navbar-nav"><a class="nav-link" href="?page=profile/profile"><img src="graphic/profilePic.jpg" alt="Profile Picture"></a>
                        <li class="navbar-nav"><a class="nav-link" href="?page=home">Home</a></li>
                        <li class="navbar-nav"><a class="nav-link" href="?page=notifications/notifications">Notifications</a></li>
                        <li class="navbar-nav"><a class="nav-link" href="?page=fitines/fitine">FitTines</a></li>
                        <li class="navbar-nav"><a class="nav-link" href="?page=followers/followers">Followers</a></li>
                        <li class="navbar-nav"><a class="nav-link" href="?page=following/following">Following</a></li>
                        <li class="navbar-nav"><a class="nav-link" href="?page=messages/messages">Messages</a></li>
                    </ul>
                </div>
            </div>
        </nav>
        
        <div>
        <?php
            include($main_content);
        ?>
        </div>
        <div class="Column right">
            <div class="rightNavigationBar">
                <div class="searchBar">
                    <p>searchBar</p>
                </div>
                <div class="rightLogo">
                    <img src="graphic/logo.png" alt="logo">
                </div>
            </div>
        </div>
    </div>
    <div id = "footer">
        <p>CopyRight Fitavate 2023</p>
    </div>
    </div>

</body>
</html>
        <!--<div id="headerLeft">
            <img src="graphic/logo.png" alt="DSE logo" >
        </div>
        <div id="headerRight">
            <nav class="navbar">
                <i class="fa-solid fa-bars"></i>
                
                <a class="nav-link" href="?page=capabilities">Capabilities</a>
                <a class="nav-link" href="?page=quality">Quality</a>
                <a class="nav-link" href="?page=gallery">Gallery</a>
                <a class="nav-link" href="?page=about">About</a>
                <a class="nav-link" href="?page=contactUs">Contact Us</a>
            </nav>
        </div>-->