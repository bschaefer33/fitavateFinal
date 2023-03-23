<?php
    session_start();
    //access to fitine functions
    require $config['LIB_PATH'] . 'fitineFunctions.php';

    //display this array in the select method
    $fullLiftArray = getAllLifts();

    //session variables from fitine page
    $newFitineName = $_SESSION['newFitine'];
    $viewStatus = $_SESSION['tempStatus'];
    if ($viewStatus == 1) {
        $true = "checked";
    }else {
        $false = "checked";
    }
    $numOfLifts= 0;
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $fitineName = $_POST['fitineName'];
        $fitineStatus = $_POST['viewStatus'];
    }

