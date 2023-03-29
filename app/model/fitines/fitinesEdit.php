<?php
    session_start();
    //access to fitine functions
    require $config['LIB_PATH'] . 'fitineFunctions.php';
    //the fitine to edit
    $fitineID = $_SESSION['editFitID'];
    $user = 1;
    //get the fitine information
    $fitine = getFitine($fitineID);
    $fitineName = $fitine['fitineName'];
    $viewStatus = $fitine['viewStatus'];
    $liftArray = getLift($fitineID);
    //determines what radio button to select
    if ($fitine['viewStatus'] == 1) {
        $true = "checked";
    }else {
        $false = "checked";
    }
    $updatedLifts = [];
    $editedLift= [];
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        print_r($fitine);
        $fitineName = $_POST['fitineName'];
        $fitineStatus = $_POST['viewStatus'];
        for ($i=0; $i<= count($_POST['liftID']); $i++) {
            $liftID = $_POST['liftID'][$i];
            $liftWt = $_POST['liftWt'][$i];
            $liftSet = $_POST['liftSet'][$i];
            $liftRep = $_POST['liftRep'][$i];
            $editedLift = array('liftID'=>$liftID, 'liftWt'=>$liftWt, 'liftSet'=>$liftSet, 'liftRep'=>$liftRep);
            array_push($updatedLifts, $editedLift);
        }
        updateFitine($fitineID, $user, $fitineName, $fitineStatus, $updatedLifts);
    }
    $fullLiftArray = getAllLifts();
    