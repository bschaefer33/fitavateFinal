<?php
// Start the session
session_start();


//Get the user's information from the database
$username = $_SESSION['userDisplayName'];
$conn = mysqli_connect("localhost", "root", "mysql", "fitavate");
$sql = "SELECT * FROM user_profile WHERE userDisplayName='$username'";
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
            <img src="<?php echo $user['userImage']; ?>" alt="Profile Picture">
		</div>
		<div class="profile-info">
			<h2><?php echo $user['firstName '] . " " . $user['lastName']; ?></h2>
			<p>Username: <?php echo $user['userDisplayName']; ?></p>
			<p>Email: <?php echo $user['email']; ?></p>
			<p>Location: <?php echo $user['city'] . ", " . $user['userState']; ?></p>
			<p>Birthday: <?php echo $user['birthday']; ?></p>
			<a class="edit-profile-btn" href="edit_profile.php">Edit Profile</a>
		</div>
	</div>
    
</body>
</html>