<?php
session_start();
require $config['LIB_PATH'] . 'fitineFunctions.php';
//get set session variables
$userIDprof =$_SESSION['user_id'];
$userFitineCheck = createCompareFitineList($userIDprof);


//second user Variables
$secUserID = $_SESSION['secondUserID'];
//make sure it isn't the user
if ($userIDprof == $secUserID) {
    header("Location: ?page=profile/profile");
}else {
    //fitavations

    $row = secondaryUserProfile($secUserID);
    $secUserDisplayName = $row['userDisplayName'];
    $secUserBio = $row['bio'];
    $secUserBirthday = date('m-d', strtotime($row['birthday']));
    $secUserCity = $row['city'];
    $secUserState = $row['userState'];
    $secUserImage = $row['userImage'];
    //get fitine information
    $fitineArray = createFitine($secUserID);
    $secUserArray = $fitineArray[0];
    $secSavedArray = $fitineArray[1];
    

    /**************************************************
     *                 FitinesTab                      *
     **************************************************/

    //used to control card output for saved arrays
    $secCount = 0;
    $secSavedCount = 0;
    //unfollow the saved fitine
    if (isset($_POST['unfollowOthersFitine'])) {
        $fitineID = $_POST['tempSaveID'];
        unfollowFitine($user, $fitineID);
        header("Location: ?page=profile/secondaryUser");
    }

    if (isset($_POST['secUserProf'])) {
        $secUserID = $_POST['secUserID'];
        $_SESSION['secondaryUser'] = $secUserID;
        header("Location: ?page=profile/secondaryUser");
    }

    if (isset($_POST['saveOthersFitine'])) {
        $secFitineID = $_POST['saveFitineID'];
        $saveOwnerID = $_POST['saveOwnerID'];
        saveFitine($userID, $secFitineID, $saveOwnerID);
    }
  
}