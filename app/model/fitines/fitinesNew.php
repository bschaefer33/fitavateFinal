<?php
    require $config['LIB_PATH'] . 'fitineFunctions.php';

    $fullLiftArray = getAllLifts();

    $userLiftArray = [];

    $tempFitineName = $_SESSION['tempFitineName'];