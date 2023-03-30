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
<html lang="en">
<head>
    <title>Profile Page</title>
</head>

<body>
	<div class="container profilePage">
		<div class="row">
			<div class="col profile-img">
				<?php
					//Fetch the user's profile picture from the database
					$userImage = $user['userImage'];
					//Convert the binary data into a base64-encoded string
					$userImageEncoded = base64_encode($userImage);
					//check if image is portriat or landscape and apply correct css - BLS
					list($w, $h, $t, $a) = getimagesizefromstring($userImage);
					if ($w > $h) {
						// Embed the base64-encoded string in an HTML img tag
						$usrImage = '<img class="circular--landscape" src="data:image/jpeg;base64,' . $userImageEncoded . '" alt="Image" />';
					} else {
						$usrImage='<img class="circular--portrait" src="data:image/jpeg;base64,' . $userImageEncoded . '" alt="Image" />';
					}
					$_SESSION['usrImage'] = $usrImage;
					echo $usrImage;
				?>
			</div>
		<div class="col profile-info">

			<!--<h2><//?php echo $user['firstName'] . " " . $user['lastName']; ?></h2>-->
			<h1>Username: <?php echo $user['userDisplayName']; ?></h1>
			<p>Email: <?php echo $user['email']; ?></p>
			<p>Location: <?php echo $user['city'] . ", " . $user['userState']; ?></p>
			<p>Birthday: <?php echo $user['birthday']; ?></p>
			<a class="edit-profile-btn" href="?page=profile/edit_profile">Edit Profile</a>
		</div>
	</div>
				</div>
</body>
</html>

