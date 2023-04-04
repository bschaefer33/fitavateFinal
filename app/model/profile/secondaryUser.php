<?php
session_start();
require $config['LIB_PATH'] . 'fitineFunctions.php';
//get set session variables
$userID = $_SESSION['user_id'];
$secUserID = $_SESSION['secondaryUser'];
$row = secondaryUserProfile($secUserID);
$secUserDisplayName = $row['userDisplayName'];
$secUserBio = $row['bio'];
$secUserBirthday = date('m-d', strtotime($row['birthday']));
$secUserCity = $row['city'];
$secUserState = $row['userState'];
$secUserImage = $row['userImage'];

//follower information
$resultFollowers = getUserFollowers($secUserID);
/***************************************************
 *                 FitinesTab                      *
 **************************************************/
//get fitine information
$fitineArray = createFitine($secUserID);
$userArray = $fitineArray[0];
$savedArray = $fitineArray[1];
//used to control card output for saved arrays
$count = 0;
$savedCount = 0;
/*unfollow the saved fitine
if (isset($_POST['unfollowFitine'])) {
    $fitineID = $_POST['tempSaveID'];
    unfollowFitine($user, $fitineID);
    header("Location: ?page=fitines/fitine");
}*/

if (isset($_POST['secUserProf'])) {
    $secUserID = $_POST['secUserID'];
    $_SESSION['secondaryUser'] = $secUserID;
    header("Location: ?page=profile/secondaryUser");
}

if (isset($_POST['saveFitine'])) {
    $secfitineID = $_POST['saveFitineID'];
    $saveOwnerID = $_POST['saveOwnerID'];
    saveFitine($userID, $secfitineID, $saveOwnerID);
}