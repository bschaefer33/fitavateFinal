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

$followCheck = createCompareFollowingCheckList($userID);
$resultFollowers = getUserFollowers($userID);
$userFollowing = getUserFollowing($userID);

$fitavationArray = getFitavations($userID);
/*Get the user's information from the database
$conn = mysqli_connect("localhost", "root", "mysql", "fitavate");
$sql = "SELECT * FROM user_profile WHERE email='$email' AND userPassword='$password'";
$result = mysqli_query($conn, $sql);
$user = mysqli_fetch_assoc($result);

mysqli_close($conn);*/
//Fetch the user's profile picture from the database
$userImage = $user['userImage'];

$birthday = date('m-d', strtotime($user['birthday']));


//used to control card output for saved arrays
$count = 0;

//unfollow the saved fitine
if (isset($_POST['unfollowFitine'])) {
    $fitineID = $_POST['saveFitineID'];
    unfollowFitine($userID, $fitineID);
    header("Location: ?page=fitines/fitine");
}

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