<?php
    session_start();

    require $config['LIB_PATH'] . 'fitineFunctions.php';

    $fullLiftArray = getAllLifts();

    $userLiftArray = [];

    $newFitineName = $_SESSION['newFitineName'];