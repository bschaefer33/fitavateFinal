<?php
session_start();
//get set session variables
$userID = $_SESSION['user_id'];
$email = $_SESSION['email'];
$resultFollowers = getUserFollowers($userID);
$userFollowing = createCompareFollowingCheckList($userID);

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