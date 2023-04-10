
<?php
session_start(); // start session (assuming using session to store user data)
$user_id = 0;

// define database connection variables
$servername = "localhost";
$username = "root";
$password = "mysql";
$dbname = "fitavate";

// create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}



// check if user is logged in
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id']; // get user ID from session
    echo 'User Login Success';
    echo '<br />';
    echo $user_id;
    echo '<br />';
  
} 

  // check if user clicked the "follow" link
  if (isset($_GET['follow'])) {
    $follower_id = $_GET['follow']; // get follower ID from URL parameter
    echo $follower_id;
    echo '<br />';

    // check if user is already following the follower
    $check_following = "SELECT * FROM follow WHERE user_id = $user_id AND following_id =$follower_id";
    $result = $conn->query($check_following);
    
    //$rows = $result->num_rows;
    if ($result->num_rows== 0) {
        // insert new follower into database
        $insert_follower = "INSERT INTO follow (user_id, following_id) VALUES ($user_id, $follower_id)";
        $conn->query($insert_follower);
        echo $user_id;
        echo $follower_id;
        echo 'Not followed yet';
    }else{
        echo 'Already followed';
        echo '<br />';
    }
  }

?>
<a href="following.php?follow=3">Follow</a>;