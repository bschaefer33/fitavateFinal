<?php
//Start the session
session_start();

//Check if the user is logged in
if (!isset($_SESSION['userDisplayName'])) {
    //If the user is not logged in, redirect to the login page
    header("Location: ?page=login/loginHome");
    exit();
}


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