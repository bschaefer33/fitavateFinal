<?php
session_start();
/*******************************************************
*  Functions are in alphabetical order
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
//finds users followers
function getUserFollowers($userID)
{
    global $connect;
    $sqlFollowers = "SELECT following_id FROM follow WHERE follow.user_id = $userID";
    $row = $connect->query($sqlFollowers);
    return $row->fetch_all(MYSQLI_ASSOC);

}
//finds people user is following
function getUserFollowing($userID)
{
    global $connect;
    $sqlFollowing = "SELECT user_id FROM follow WHERE follow.following_id = $userID";
    $row = $connect->query($sqlFollowing);
    return $row->fetch_all(MYSQLI_ASSOC);
}
//gets the secondary users name and image
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
//creates a list of people following user
function createCompareFollowList($userID)
{
    global $connect;
    $followCheck = array();
    $sqlCompareQuery = "SELECT following_id FROM follow WHERE user_id = $userID";
    $row = $connect->query($sqlCompareQuery);
    while ($result = $row->fetch_assoc()) {
        $followID = $result['following_id'];
        array_push($followCheck, $followID);
    }
    return $followCheck;
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

function unfollowUser($firstUserId, $otherUser)
{
    global $connect;
    $sqlUnfollow = "DELETE FROM follow WHERE follow.following_id = $firstUserId AND follow.user_id = $otherUser";
    $connect->query($sqlUnfollow);
}
function followUser($userId, $otherUser)
{
    global $connect;
    $sqlUnfollow = "INSERT INTO `follow`(`user_id`, `following_id`) VALUES ('".$otherUser."','".$userId."')";
    $connect->query($sqlUnfollow);

}

function getOtherFitavations($userID)
{
    global $connect;
    $usersFollowing = createCompareFollowingCheckList($userID);
    $fitavationArray = array();
    foreach ($usersFollowing as $otherUser) {
        $otherUserID = $otherUser['user_id'];
        $sql= "SELECT * FROM fitavation WHERE fitavation.user_id = $otherUserID";
        $row = $connect->query($sql);
        while ($result = $row->fetch_assoc()) {
            array_push($fitavationArray, $result);
        }
        $userUserFollowing = createCompareFollowingCheckList($otherUserID);
        foreach ($userUserFollowing as $secondOtherUser) {
            $secondOtherUserID = $secondOtherUser['user_id'];
            $sqlFollowing= "SELECT * FROM fitavation WHERE fitavation.user_id = $secondOtherUserID";
            $rowTwo = $connect->query($sqlFollowing);
            while ($resultTwo = $rowTwo->fetch_assoc()) {
                if (in_array($secondOtherUser['fitavation_id'], $fitavationArray) == false) {
                    array_push($fitavationArray, $resultTwo);
                }
                
            }
        }
    }
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
