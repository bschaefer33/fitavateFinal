<!DOCTYPE html>
<html>
<head>
    <title>Edit Profile</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <div class="form-container">
        <h2>Edit Profile</h2>
        <form action="?page=profile/edit_profile" method="POST" enctype="multipart/form-data">
          <label for="firstName">First Name:</label>
          <input type="text" id="firstName" name="firstName" value="<?php echo $user['firstName']; ?>" required>
          <label for="lastName">Last Name:</label>
          <input type="text" id="lastName" name="lastName" value="<?php echo $user['lastName']; ?>" required>
          <label for="email">Email:</label>
          <input type="email" id="email" name="email" value="<?php echo $user['email']; ?>" required>
          <label for="userPassword">Password:</label>
          <input type="password" id="userPassword" name="userPassword" value="<?php echo $user['userPassword']; ?>" required>
          <label for="city">City:</label>
          <input type="text" id="city" name="city" value="<?php echo $user['city']; ?>" required>
          <label for="userState">State:</label>
          <input type="text" id="userState" name="userState" value="<?php echo $user['userState']; ?>" required>
          <label for="birthday">Birthday:</label>
          <input type="date" id="birthday" name="birthday" value="<?php echo $user['birthday']; ?>" required>
          <label for="userImage">Profile Picture:</label>
          <input type="file" id="userImage" name="userImage">
          <input type="submit" value="Submit">
        </form>
    </div>
</body>
</html>