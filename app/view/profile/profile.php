<?php
//Start the session
session_start();

//Get the user's information from the database
$email = $_SESSION['email'];
$password = $_SESSION['userPassword'];
$conn = mysqli_connect("localhost", "root", "mysql", "fitavate");
$sql = "SELECT * FROM user_profile WHERE email='$email' AND userPassword='$password'";
$result = mysqli_query($conn, $sql);
$user = mysqli_fetch_assoc($result);


mysqli_close($conn);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Profile Page</title>
</head>

<body>
    <div class="header">
		<h1>User Profile</h1>
	</div>
	<div class="container">
		<div class="profile-img">
           <?php 
            //Fetch the user's profile picture from the database
            $userImage = $user['userImage'];
            //Convert the binary data into a base64-encoded string
            $userImageEncoded = base64_encode($userImage);
            // Embed the base64-encoded string in an HTML img tag
            echo '<img src="data:image/jpeg;base64,' . $userImageEncoded . '" alt="Image" />';
           ?>
		</div>
		<div class="profile-info">
			<h2><?php echo $user['firstName'] . " " . $user['lastName']; ?></h2>
			<p>Username: <?php echo $user['userDisplayName']; ?></p>
			<p>Email: <?php echo $user['email']; ?></p>
			<p>Location: <?php echo $user['city'] . ", " . $user['userState']; ?></p>
			<p>Birthday: <?php echo $user['birthday']; ?></p>
			<a class="edit-profile-btn" href="?page=profile/edit_profile">Edit Profile</a>
		</div>
	</div>
    
</body>
</html>
