<?php
    session_start();
    //access to fitine functions
    require $config['LIB_PATH'] . 'fitineFunctions.php';
    //the fitine to edit
    $fitineID = $_SESSION['editFitID'];
    $user = $_SESSION['user_id'];
    //get the fitine information
    $fitine = getFitine($fitineID);
    $fitineName = $fitine['fitineName'];
    $viewStatus = $fitine['viewStatus'];
    $liftArray = getLift($fitineID);
    $fullLiftArray = getAllLifts();
    //determines what radio button to select
    if ($fitine['viewStatus'] == 1) {
        $true = "checked";
    }else {
        $false = "checked";
    }
    $updatedLifts = [];
    $editedLift= [];
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $fitineName = $_POST['fitineName'];
        $fitineStatus = $_POST['viewStatus'];
        for ($i=0; $i<= count($_POST['editLiftID']); $i++) {
            $liftID = $_POST['editLiftID'][$i];
            $liftWt = $_POST['editLiftWt'][$i];
            $liftSet = $_POST['editLiftSet'][$i];
            $liftRep = $_POST['editLiftRep'][$i];
            $editedLift = array('liftID'=>$liftID, 'liftWt'=>$liftWt, 'liftSet'=>$liftSet, 'liftRep'=>$liftRep);
            array_push($updatedLifts, $editedLift);
        }
        updateFitine($fitineID, $fitineName, $fitineStatus, $updatedLifts);
        header("Location: ?page=fitines/fitine");
    }
   
    