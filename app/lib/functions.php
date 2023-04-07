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
function get($name, $def='')
{
    return isset($_REQUEST[$name]) ? $_REQUEST[$name] : $def;
}
function displayResult($result, $sql){
    if ($result-> num_rows>0){
        echo "<table border='1'>";
        $heading = $result-> fetch_assoc();
        echo "<tr>";
        foreach($heading as $key=>$value){
            echo "<th>". $key . "</th>";
        }
        echo "</tr>";
        echo "<tr>";
        foreach($heading as $key=>$value){
            echo "<td>" . $value . "</td>";
        }
        while($row=$result->fetch_assoc()){
            echo "<tr>";
            foreach($row as $key=>$value) {
                echo "<td>" . $value. "</td>";
            }
            echo"</tr>";
        }
        echo "</table>";
    }else{
        echo "<strong>zero results using SQL: </strong>". $sql;
    }
}
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
function getUserFollowers($userID)
{
    global $connect;
    $sqlFollowers = "SELECT following_id FROM follow WHERE follow.user_id = $userID";
    return $connect->query($sqlFollowers);
}

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