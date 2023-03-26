<?php
    require $config['LIB_PATH'] . 'fitineFunctions.php';

    $fullLiftArray = getAllLifts();
    $liftArray = [];

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

    if(isset($_POST['listLift']) && !($_POST['listLift'] == 'null')){
        $selection = $_POST['listLift'];
        $sql = "SELECT * FROM lift
                JOIN muscleGroup ON lift.muscleGroup_id = muscleGroup.muscleGroup_id
                WHERE lift.lift_id = $selection";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();

        $thisLift = [
            "lift_id" => $row['lift_id'],
            "mgID" => $row['muscleGroup_id'],
            "liftName" => $row['liftName'],
            "muscleName" => $row['muscleGroupName']
        ];
        array_push($liftArray, $thisLift);
    }

