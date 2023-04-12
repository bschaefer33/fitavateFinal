<?php
session_start();
require $config['LIB_PATH'] . 'fitineFunctions.php';
//get set session variables
$userIDprof =$_SESSION['user_id'];
$userFitineCheck = createCompareFitineList($userIDprof);
$userFollowCheck = createCompareFollowingCheckList($userIDprof);

//second user Variables
$secUserID = $_SESSION['secondUserID'];
//make sure it isn't the user
if ($userIDprof == $secUserID) {
    header("Location: ?page=profile/profile");
}else {
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
    
    //follower information
    $secondUserFollowers = getUserFollowers($secUserID);
    $secondUserFollowing = getUserFollowing($secUserID);
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
    /**************************************************
     *           Second User Followers                *
     **************************************************/
    if (isset($_POST['unfollowOtherUser'])) {
        $userToUnfollow = $_POST['saveOtherUserID'];
        unfollowUser($userIDprof, $userToUnfollow);
        header("Refresh:0");
    }
    
    if (isset($_POST['followOtherUser'])) {
        $userToFollow = $_POST['saveOtherUserID'];
        followUser($userIDprof, $userToFollow);
        header("Refresh:0");
    }
    if (isset($_POST['viewProfile'])) {
        $secondUser = $_POST['saveOtherUserID'];
        $_SESSION['secondUserID'] = $secondUser;
        header("Refresh:0");
    }
}