<?php
    session_start();
    require $config['LIB_PATH'] . 'fitineFunctions.php';
    //get set session variables
    $userID = $_SESSION['user_id'];
    $userImage = $_SESSION['userImage'];
    $userDisplayName = $_SESSION['userDisplayName'];
    $fitavationArray = getOtherFitavations($userID);
    $followCheck = createCompareFollowingCheckList($userID);
    
    //followers
if (isset($_POST['viewProfile'])) {
    $secondUser = $_POST['saveSecUserID'];
    $_SESSION['secondUserID'] = $secondUser;
    header("Location: ?page=profile/secondaryUser");
}

if (isset($_POST['unfollowUser'])) {
    $userToUnfollow = $_POST['saveSecUserID'];
    unfollowUser($userID, $userToUnfollow);
    header("Refresh:0");
}

if (isset($_POST['followUser'])) {
    $userToFollow = $_POST['saveSecUserID'];
    followUser($userID, $userToFollow);
    header("Refresh:0");
}

if (isset($_POST['submitFitavation'])) {
    $fitavationUserID = $_POST['fitavationUserID'];
    $fitavationText = $_POST['fitavationText'];
    postFitavation($userID, $fitavationText);
    header("Refresh:0");
}