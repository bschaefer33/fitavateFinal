<?php
session_start();
/*******************************************************
*  Functions are sorted by use
*******************************************************/
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
//page controller
function get($name, $def='')
{
    return isset($_REQUEST[$name]) ? $_REQUEST[$name] : $def;
}
//prints Users Image
/*******************************************************
*  Profile functions
*******************************************************/
/*****************    User's Profile    ***************/
//userTemplate image
function printImage($image)
{
    //Convert the binary data into a base64-encoded string
    $userImageEncoded = base64_encode($image);
    //check if image is portriat or landscape and apply correct css - BLS
    list($w, $h, $t, $a) = getimagesizefromstring($image);
    if ($w > $h) {
        // Embed the base64-encoded string in an HTML img tag
        echo '<img class="circular--landscape" src="data:image/jpeg;base64,' . $userImageEncoded . '" alt="Image" />';
    } else {
        echo '<img class="circular--portrait" src="data:image/jpeg;base64,' . $userImageEncoded . '" alt="Image" />';
    }
}
/*****************    Secondary User's Profile    ***************/
//prints Others Images (smaller)
function printImageOthers($image)
{
    //Convert the binary data into a base64-encoded string
    $userImageEncoded = base64_encode($image);
    //check if image is portriat or landscape and apply correct css - BLS
    list($w, $h, $t, $a) = getimagesizefromstring($image);
    if ($w > $h) {
        // Embed the base64-encoded string in an HTML img tag
        echo '<img class="smallProfileImgLand" src="data:image/jpeg;base64,' . $userImageEncoded . '" alt="Image" />';
    } else {
        echo '<img class="smallProfileImgPort" src="data:image/jpeg;base64,' . $userImageEncoded . '" alt="Image" />';
    }
}
//gets the secondary users name and image file
function createSecondaryUser($secondUser)
{
    global $connect;
    $sqlSecondary = "SELECT userDisplayName,
                    userImage
                    FROM user_profile
                    WHERE user_profile.user_id = $secondUser";
    $row= $connect->query($sqlSecondary);
    $result = $row->fetch_assoc();
    return array("userDisplay"=>$result['userDisplayName'], "userImage"=>$result['userImage']);
}
//used for secondary user profile page
function secondaryUserProfile($secondUser)
{
    global $connect;
    $sqlSecondary ="SELECT user_profile.userDisplayName,
                    user_profile.bio,
                    user_profile.birthday,
                    user_profile.city,
                    user_profile.userState,
                    user_profile.userImage
                    FROM user_profile
                    WHERE user_profile.user_id = $secondUser";
    $result = $connect->query($sqlSecondary);
    return $result->fetch_assoc();
}
/*******************************************************
*  Follow/Following Functions
*******************************************************/
//creates a list of followers that are following the user
function getUserFollowers($userID)
{
    global $connect;
    $sqlFollowers = "SELECT following_id FROM follow WHERE follow.user_id = $userID";
    $row = $connect->query($sqlFollowers);
    return $row->fetch_all(MYSQLI_ASSOC);

}
//creates a list of people the user is following
function createCompareFollowingCheckList($userID)
{
    global $connect;
    $followingCheck = array();
    $sqlCompareQuery = "SELECT follow.user_id FROM follow WHERE follow.following_id = $userID";
    $row = $connect->query($sqlCompareQuery);
    while ($result = $row->fetch_assoc()) {
        $followingID = $result['user_id'];
        array_push($followingCheck, $followingID);
    }
    return $followingCheck;
}
//User unfollows a secondary user
function unfollowUser($userId, $otherUser)
{
    global $connect;
    $sqlUnfollow = "DELETE FROM follow WHERE follow.following_id = $userId AND follow.user_id = $otherUser";
    $connect->query($sqlUnfollow);
}
//User follows a secondary user
function followUser($userId, $otherUser)
{
    global $connect;
    $sqlFollow = "INSERT INTO `follow`(`user_id`, `following_id`) VALUES ('$otherUser','$userId')";
    $connect->query($sqlFollow);
}
/*******************************************************
*  Fitavations functions
*******************************************************/
//helper function that creates a list to get fitavations from
function fitavationFollowList($userID)
{
    $userFollowingArray = array();
    $usersFollowing = createCompareFollowingCheckList($userID);
    foreach ($usersFollowing as $following) {
        array_push($userFollowingArray, $following);
        $followingFollow = createCompareFollowingCheckList($following['user_id']);
        foreach ($followingFollow as $follow) {
            array_push($userFollowingArray, $follow['user_id']);
        }
    }
    return array_unique($userFollowingArray);
}
function getOtherFitavations($userID)
{
    global $connect;
    $userArray = fitavationFollowList($userID);
    $createdAt = [];
    $fitavationArray = array();
    foreach ($userArray as $otherUser) {
        $otherUserID = $otherUser['user_id'];
        $sql= "SELECT * FROM fitavation WHERE fitavation.user_id = $otherUserID";
        $row = $connect->query($sql);
        while ($result = $row->fetch_assoc()) {
            array_push($fitavationArray, $result);
        }
    }
    $userFitavationArray = getFitavations($userID);
    foreach ($userFitavationArray as $userFitavation) {
        array_push($fitavationArray, $userFitavation);
    }
    foreach ($fitavationArray as $key => $row) {
        $createdAt[$key] = $row['createdAt'];
    }
    array_multisort($createdAt, SORT_DESC, $fitavationArray);
    return $fitavationArray;
}
function getFitavations($userID)
{
    global $connect;
    $fitavationArray= array();
    $sql= "SELECT * FROM fitavation WHERE fitavation.user_id = $userID";
    $row = $connect->query($sql);
    while ($result = $row->fetch_assoc()) {
        array_push($fitavationArray, $result);
    }
    return $fitavationArray;
}
function postFitavation($userID, $fitavationText)
{
    global $connect;
    $sqlFitavation= "INSERT INTO `fitavation`(`user_id`, `fitavation`, `likes`) VALUES ('$userID', '$fitavationText', '0')";
    $connect->query($sqlFitavation);
}