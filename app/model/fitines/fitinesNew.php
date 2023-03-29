<?php
    session_start();
    //access to fitine functions
    require $config['LIB_PATH'] . 'fitineFunctions.php';

    //display this array in the select method
    $fullLiftArray = getAllLifts();
    $newUserLifts = [];
    //session variables from fitine page
    $newFitineName = $_SESSION['newFitine'];
    $viewStatus = $_SESSION['tempStatus'];
    $user = 1;
    //to select the correct radio button
    if ($viewStatus == 1) {
        $true = "checked";
    }else {
        $false = "checked";
    }
    //array to update the database
    $lift = [];
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $fitineName = $_POST['fitineName'];
        $fitineStatus = $_POST['viewStatus'];
        for ($i=0; $i<= count($_POST['liftID']); $i++) {
            $liftID = $_POST['liftID'][$i];
            $liftWt = $_POST['liftWt'][$i];
            $liftSet = $_POST['liftSet'][$i];
            $liftRep = $_POST['liftRep'][$i];
            $lift = array('liftID'=>$liftID, 'liftWt'=>$liftWt, 'liftSet'=>$liftSet, 'liftRep'=>$liftRep);
            array_push($newUserLifts, $lift);
        }
        addNewFitine($user, $fitineName, $fitineStatus, $newUserLifts);
        header("Location: ?page=fitines/fitine");
    }

