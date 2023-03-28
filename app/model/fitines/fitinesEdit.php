<?php
    session_start();
    //access to fitine functions
    require $config['LIB_PATH'] . 'fitineFunctions.php';
    
    $fitineID = $_SESSION['editFitID'];
    
    $fitine = getFitine($fitineID);
    $fitineName = $fitine['fitineName'];
    $viewStatus = $fitine['viewStatus'];
    $liftArray = getLift($fitineID);

    if ($fitine['viewStatus'] == 1) {
        $true = "checked";
    }else {
        $false = "checked";
    }
    $numOfLifts;
    $updatedUserLifts = [];
    $lift = [];
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $fitineName = $_POST['fitineName'];
        $fitineStatus = $_POST['viewStatus'];
        for ($i=0; $i<= $numOfLifts; $i++){
            $liftID = $_POST['liftID'][$i];
            $liftWt = $_POST['liftWt'][$i];
            $liftSet = $_POST['liftSet'][$i];
            $liftRep = $_POST['liftRep'][$i];
            $lift = array('liftID'=>$liftID, 'liftWt'=>$liftWt, 'liftSet'=>$liftSet, 'liftRep'=>$liftRep);
            array_push($newUserLifts, $lift);
        }
        updateFitine($fitineID, $fitineName,$fitineStatus,$newUserLifts);
        $numOfLifts = 0;
        header("Location: ?page=fitines/fitine");
    }
    function printLifts($lift)
    {
        global $numOfLifts;
        $fullLiftArray = getAllLifts();
        echo '<div class="form-group row" id="liftSel">';
            echo '<select class="col" id="listLifts" name="liftID[]">';
                echo '<option value="null" >Add New Lift</option>';
                foreach ($fullLiftArray as $liftSelect){
                    if ($lift['lift_id'] == $liftSelect['lift_id']) {
                        echo '<option selected value ="'.$liftSelect["lift_id"].'">'.$liftSelect["liftName"].'</option>';
                    }else {
                        echo '<option value ="'.$liftSelect["lift_id"].'">'.$liftSelect["liftName"].'</option>';
                    }
                }
            echo '</select>';
            echo '<input class="col" type="text" id="liftWtInput" name="liftWt[]" value="'.$lift["liftWeight"].'"/>';
            echo '<input class="col" type="text" id="liftSetsInput" name="liftSet[]" value="'.$lift["liftSet"].'"/>';
            echo '<input class="col" type="text" id="liftRepsInput" name="liftRep[]" value="'.$lift["liftRep"].'"/></div>';
    }
