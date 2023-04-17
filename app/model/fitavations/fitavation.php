<?php
session_start();
    require $config['LIB_PATH'] . 'fitineFunctions.php';
    //get set session variables
    $userID = $_SESSION['user_id'];
    $userImage = $_SESSION['userImage'];
    $userDisplayName = $_SESSION['userDisplayName'];
    $fitavationArray = getFitavations($userID);