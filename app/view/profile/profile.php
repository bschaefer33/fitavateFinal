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
//Fetch the user's profile picture from the database
$userImage = $user['userImage'];

$birthday = date('m-d', strtotime($user['birthday']));
$_SESSION['userImage'] = $userImage;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Profile Page</title>
</head>

<body>
	<div class="container profilePage">
		<div class="row align-items-center justify-content-center profileHeader">
			<div class="col col-sm-4 profile-img">
				<?php printImage($userImage) ?>
			</div>
			<div class="col profile-info">
				<div class="row userName">
					<h1 class="col col-sm-10"><?php echo $user['userDisplayName']; ?></h1>
					<div class="col col-sm-2">
						<a class="btn editButton" href="?page=profile/edit_profile">Edit Profile</a>
					</div>
				</div>
				<div class="row profStats">
					<h5 class="col"><?php echo $user['city'] . ", " . $user['userState']; ?></h5>
					<h5 class="col">Birthday: <?php echo $birthday; ?></h5>
				</div>
			</div>

		</div>
		<div class="row pageContent">
			<ul class="nav nav-tabs" role="tablist">
				<li class="nav-item">
					<a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab">Home</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" id="fitines-tab" data-toggle="tab" href="#fitines" role="tab">Fitines</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" id="followers-tab" data-toggle="tab" href="#followers" role="tab">Followers</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" id="following-tab" data-toggle="tab" href="#following" role="tab">Following</a>
				</li>
			</ul>
			<div class="tab-content" id="myTabContent">
				<div class="tab-pane fade show active" id="home" role="tabpanel"><?php include('?page=home') ?></div>
				<div class="tab-pane fade" id="fitines" role="tabpanel"><?php include('?page=fitines/fitine') ?></div>
				<div class="tab-pane fade" id="followers" role="tabpanel">...</div>
				<div class="tab-pane fade" id="following" role="tabpanel">...</div>
			</div>
		</div>
	</div>
</body>
</html>

