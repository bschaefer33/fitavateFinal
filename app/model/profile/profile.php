<?php
session_start();
require $config['LIB_PATH'] . 'fitineFunctions.php';
//get set session variables
$userID = $_SESSION['user_id'];
$email = $_SESSION['email'];
$password = $_SESSION['userPassword'];
$userDisplayName = $_SESSION['userDisplayName'];
$userBio = $_SESSION['userBio'];
$userImage = $_SESSION['userImage'];
$userCity = $_SESSION['userCity'];
$userState = $_SESSION['userState'];
$userBirthday = $_SESSION['userDOB'];

//get fitine information
$fitineArray = createFitine($userID);
$userArray = $fitineArray[0];
$savedArray = $fitineArray[1];

$resultFollowers = getUserFollowers($userID);
//Get the user's information from the database

$conn = mysqli_connect("localhost", "root", "mysql", "fitavate");
$sql = "SELECT * FROM user_profile WHERE email='$email' AND userPassword='$password'";
$result = mysqli_query($conn, $sql);
$user = mysqli_fetch_assoc($result);

mysqli_close($conn);
//Fetch the user's profile picture from the database
$userImage = $user['userImage'];

$birthday = date('m-d', strtotime($user['birthday']));


//used to control card output for saved arrays
$count = 0;

//new fitine information
$fitineName = ($_POST['newFitineName']);
$viewStatus = ($_POST['tempViewStatus']);

//Sets session variables for when the user wants to create a new fitine
if (isset($_POST['fitineSubmit']) && isset($_POST['newFitineName']) && isset($_POST['tempViewStatus'])) {
    $_SESSION['newFitine'] = $fitineName;
    $_SESSION['tempStatus'] = $viewStatus;
    header("Location: ?page=fitines/fitinesNew");
}

//edit current fitine and set the session variable
if (isset($_POST['fitineEdit'])) {
    $fitineID = $_POST['tempFitID'];
    $_SESSION['editFitID'] = $fitineID;
    header("Location: ?page=fitines/fitinesEdit");
}

//Deletes fitine and reloads the page
if (isset($_POST['fitineDelete'])) {
    $fitineID = $_POST['tempFitID'];
    deleteUserFitine($fitineID);
    header("Location: ?page=fitines/fitine");
}

//unfollow the saved fitine
if (isset($_POST['unfollowFitine'])) {
    $fitineID = $_POST['tempSaveID'];
    unfollowFitine($userID, $fitineID);
    header("Location: ?page=fitines/fitine");
}

//followers

