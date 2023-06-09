<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <link rel= "styleSheet" href="styleSheet.css">
    <title>Profile Page</title>
</head>
<body>
    <div class="container profileEditPage">
        <div class="row justify-content-center pageHeaderProfile">
            <h1 class="sectionHeaderProfile">Edit Profile</h1>
        </div>
        <div class="container p-3 formContainer">
            <form id="editForm" action="?page=profile/edit_profile" method="POST" enctype="multipart/form-data">
                <div class="form-group row align-items-center justify-content-center">
                    <div class="form-group col-4">
                        <?php printImage($userImage) ?>
                    </div>
                    <div class="form-group col-7">
                        <div class="form-group row align-items-center justify-content-between">
                            <label class="col-2" for="displayName">Display Name</label>
                            <input class="form-control col-4" type="text" id="userDisplayName" name="userDisplayName" value="<?php echo $userDisplayName; ?>" required>
                            <label class="col-2" for="birthday">Birthday</label>
                            <input class="form-control col-3" type="date" id="birthday" name="birthday" value="<?php echo $birthday; ?>" required>
                        </div>
                        <div class="form-group row align-items-center justify-content-between">
                            <label class="col-2" for="firstName">First Name</label>
                            <input class="form-control col-4" type="text" id="firstName" name="firstName" value="<?php echo $first_name; ?>" required>
                            <label class="col-2" for="lastName">Last Name</label>
                            <input class="form-control col-3" type="text" id="lastName" name="lastName" value="<?php echo $last_name; ?>" required>
                        </div>
                        <div class="form-group row align-items-center justify-content-between">
                            <label class="col-2" for="email">Email</label>
                            <input class="form-control col-4" type="email" id="email" name="email" value="<?php echo $email; ?>" required>
                            <label class="col-2" for="userPassword">Password</label>
                            <input class="form-control col-3" type="password" id="userPassword" name="userPassword" value="<?php echo $password; ?>" required>
                        </div>
                        <div class="form-group row align-items-center justify-content-between">
                            <label class="col-2" for="city">City</label>
                            <input class="form-control col-4" type="text" id="city" name="city" value="<?php echo $city; ?>" required>
                            <label class="col-2" for="userState">State</label>
                            <input class="form-control col-3" type="text" id="userState" name="userState" value="<?php echo $state; ?>" required>
                        </div>
                    </div>
                </div>
                <div class="form-group row userImageInput">
                    <input class="form-control-file" type="file" name="userImage" value="<?php $userImage ?>">
                </div>
                <div class="form-group row align-items-center justify-content-center">
                    <label for="bio">Update your Bio</label>
                    <textarea class="form-control" id="bio" name="bio" value="<?php echo $bio; ?>" required></textarea>
                </div>
                <div class="form-group row align-items-center justify-content-center">
                    <input type="submit" value="Submit">
                </div>
            </form>
        </div>
       
    </div>
</body>
</html>