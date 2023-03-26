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

    /*while (!isset($_POST['submitForm'])) {
        if (isset($_POST['liftbutton'])) {
            addlift();
        }
    }*/

    function addLift()
    {
        global $fullLiftArray;
        echo '<select class="custom-select" id="lifts" name="lift">';
        echo '<option selected>Add New Lift</option>';
            foreach ($fullLiftArray as $lift) {
                echo '<option value ="'.$lift['lift_id'].'"><'.$lift->liftName.'></option>';
            }
        echo '</select>';
        echo '<div class="row">';
            echo '<div class="col">';
                echo '<label for="liftWt">Weight (lbs.)</label>';
                echo '<input type="text" class="form-control" id="liftWt" />';
            echo '</div>';
            echo '<div class="col">';
                echo '<label for="liftSet">Sets</label>';
                echo ' <input type="text" class="form-control" id="liftSet" />';
            echo '</div>';
            echo ' <div class="col">';
                echo '<label for="liftRep">LiftRep</label>';
                echo '<input type="text" class="form-control" id="liftRep" />';
            echo '</div>';
        echo ' </div>';
    }