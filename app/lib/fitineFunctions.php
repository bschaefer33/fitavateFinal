<?php
session_start();
//Establish our database user name password and the name of the database
$DBF_PASS = "mysql";
$DBF_USER = "root";
$DBF_NAME = "fitavate";
//Connect our database to the program
$connect = mysqli_connect("localhost", "$DBF_USER", "$DBF_PASS", "$DBF_NAME");
//check connection
if ($connect->connect_error) {
    die("Connection failed: ".$connect->connect_error);
}
require $config['LIB_PATH'] . 'Fitine.php';
require $config['LIB_PATH'] . 'Lift.php';

//Used on Fitine Home page to display the user's created and saved fitines.
function createFitine($user)
{
    global $connect;
    $fitineArrayOther= [];
    $fitineArrayUser = [];
    $fitines = [];
    $sql = "SELECT userFitine.fitine_id,
                userFitine.owner_id,
                fitine.fitineName,
                fitine.viewStatus,
                fitine.date_created
            FROM userFitine
            JOIN fitine ON userFitine.fitine_id = fitine.fitine_id
            WHERE userFitine.user_id = $user";
    $result = $connect->query($sql);
    while ($row = $result->fetch_assoc()) {
        $liftArray = createLift($row['fitine_id']);
        $owner = createOwnerDisplay($row['owner_id']);
        $fitine = new Fitine($user, $row['fitine_id'], $row['owner_id'], $owner['ownerDisplay'], $owner['ownerImage'], $row['fitineName'], $row['viewStatus'], $row['date_created'], $liftArray);
        if ($user == $row['owner_id']) {
            array_push($fitineArrayUser, $fitine);
        } else {
            array_push($fitineArrayOther, $fitine);
        }
    }
    array_push($fitines, $fitineArrayUser);
    array_push($fitines, $fitineArrayOther);
    return $fitines;
}

//Used on Fitine Home page to display the user's created and saved fitines.
function createLift($fitineId)
{
    global $connect;
    $liftArray = [];
    $sql = "SELECT fitine.fitine_id,
                fitineLift.lift_id,
                fitineLift.liftWeight,
                fitineLift.liftSet,
                fitineLift.liftRep,
                lift.liftName,
                muscleGroup.muscleGroup_id,
                muscleGroup.muscleGroupName
            FROM fitine
            JOIN fitineLift ON fitine.fitine_id = fitineLift.fitine_id
            JOIN lift ON fitineLift.lift_id = lift.lift_id
            JOIN muscleGroup ON lift.muscleGroup_id = muscleGroup.muscleGroup_id
            WHERE fitine.fitine_id = $fitineId";
    $result = $connect->query($sql);
    while ($row = $result->fetch_assoc()) {
        $lift = new Lift($row['fitine_id'], $row['lift_id'], $row['liftWeight'], $row['liftSet'], $row['liftRep'], $row['liftName'], $row['muscleGroup_id'], $row['muscleGroupName']);
        array_push($liftArray, $lift);
    }
    return $liftArray;
}

//sends the sorted fitines to the fitine homepage model
function getUserFitines()
{
    global $fitineArrayUser;
    return $fitineArrayUser;
}
function getSavedFitines()
{
    global $fitineArrayOther;
    return $fitineArrayOther;
}

//Used to get the owner id's name
function createOwnerDisplay($secondUser)
{
    global $connect;
    $sqlSecondary = "SELECT userDisplayName,
                    userImage
                    FROM user_profile
                    WHERE user_profile.user_id = $secondUser";
    $row= $connect->query($sqlSecondary);
    $result = $row->fetch_assoc();
    return array("ownerDisplay"=>$result['userDisplayName'], "ownerImage"=>$result['userImage']);
    
}

function getFitine($fitineID)
{
    global $connect;
    $sql = "SELECT fitine.fitineName,
                fitine.viewStatus
            FROM fitine
            WHERE fitine.fitine_id = $fitineID";
    $result = $connect->query($sql);
    return $result->fetch_assoc();
}
function getLift($fitineID)
{
    global $connect;
    $liftArray = [];
    $sql = "SELECT fitineLift.lift_id,
                fitineLift.liftWeight,
                fitineLift.liftSet,
                fitineLift.liftRep,
                lift.liftName
            FROM fitine
            JOIN fitineLift ON fitine.fitine_id = fitineLift.fitine_id
            JOIN lift ON fitineLift.lift_id = lift.lift_id
            WHERE fitine.fitine_id = $fitineID";
    $result = $connect->query($sql);
    while ($row = $result->fetch_assoc()) {
        array_push($liftArray, $row);
    }
    return $liftArray;
}


function updateFitine($fitineID, $fitineName, $fitineStatus, $editUserLifts)
{
    global $connect;
    $sql = "UPDATE fitine SET fitineName = '$fitineName', viewStatus = '$fitineStatus' WHERE fitine_id = '$fitineID'";
    $connect->query($sql);
    $sqlDelete = "DELETE FROM fitineLift WHERE fitineLift.fitine_id = $fitineID";
    $connect->query($sqlDelete);
    foreach ($editUserLifts as $lift) {
        $sqlFitLift = "INSERT INTO fitineLift(fitine_id,lift_id,liftWeight,liftSet,liftRep)
                VALUES ('$fitineID','$lift[liftID]','$lift[liftWt]', '$lift[liftSet]', '$lift[liftRep]')";
        $connect->query($sqlFitLift);
    }

}

//Used in the edit and new fitine pages to display lifts in the select/dropdown element
function getAllLifts()
{
    global $connect;
    $sql = "SELECT * FROM lift JOIN muscleGroup ON lift.muscleGroup_id = muscleGroup.muscleGroup_id";
    return $connect->query($sql);
}

function addNewFitine($user, $name, $viewStatus, $liftArray)
{
    global $connect;
    $sql = "INSERT INTO fitine(fitineName, viewStatus) VALUES ('$name', '$viewStatus')";
    if ($connect->query($sql) === true) {
        $fitineID = $connect->insert_id;
        $sqlUser = "INSERT INTO userFitine(user_id, fitine_id, owner_id) VALUES ('$user', '$fitineID', '$user')";
        $connect->query($sqlUser);
        foreach ($liftArray as $lift) {
            $sqlFitLift = "INSERT INTO fitineLift(fitine_id,lift_id,liftWeight,liftSet,liftRep)
                VALUES ('$fitineID','$lift[liftID]','$lift[liftWt]', '$lift[liftSet]', '$lift[liftRep]')";
            $connect->query($sqlFitLift);
        }
    } else {
        echo "Error";
    }
}

function deleteUserFitine($fitineID)
{
    global $connect;
    $sql = "DELETE FROM fitineLift WHERE fitineLift.fitine_id = $fitineID";
    $sql1 = "DELETE FROM userFitine WHERE userFitine.fitine_id = $fitineID";
    $sql2 = "DELETE FROM fitine WHERE fitine.fitine_id = $fitineID";
    $connect->query($sql);
    $connect->query($sql1);
    $connect->query($sql2);
}
function unfollowFitine($user, $fitineID)
{
    global $connect;
    $sql = "DELETE FROM userFitine WHERE userFitine.fitine_id = $fitineID AND userFitine.user_id = $user";
    $connect->query($sql);
}
function saveFitine($userID,$fitineID,$ownerID)
{
    global $connect;
    $sqlFitine = "INSERT INTO userFitine(user_id, fitine_id, owner_id) VALUES ('$userID', '$fitineID', '$ownerID')";
    $connect->query($sqlFitine);
}
function createCompareFitineList($userID)
{
    global $connect;
    $fitineCheck = array();
    $sqlCompareQuery = "SELECT userFitine.fitine_id FROM userFitine WHERE userFitine.user_id = $userID";
    $row = $connect->query($sqlCompareQuery);
    while ($result = $row->fetch_assoc()) {
        $fitineID = $result['fitine_id'];
        array_push($fitineCheck, $fitineID);
    }
    return $fitineCheck;
}
