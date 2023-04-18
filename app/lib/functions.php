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

