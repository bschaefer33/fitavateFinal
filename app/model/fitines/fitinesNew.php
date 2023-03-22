<?php

    require $config['LIB_PATH'] . 'fitineFunctions.php';

    $fullLiftArray = getAllLifts();

    $userLiftArray = [];

    if (isset($_SESSION['newFitineName'])) {
        echo $_SESSION['newFitineName'];
    } else {
        print_r($_SESSION);
    }