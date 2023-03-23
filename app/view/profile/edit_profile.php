<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['userDisplayName'])) {
    // If the user is not logged in, redirect to the login page
    header("Location: ?page=login/loginHome");
    exit();
}


//Get the user's information from the database
$conn = mysqli_connect("localhost", "root", "mysql", "fitavate");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$username = $_SESSION['userDisplayName'];

$sql = "SELECT * FROM user_profile WHERE userDisplayName='$username'";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) === 1) {
    $user = mysqli_fetch_assoc($result);
} else {
    die("Error: User not found");
}

//Check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    //Get form data
    $first_name = $_POST['firstName'];
    $last_name = $_POST['lastName'];
    $email = $_POST['email'];
    $city = $_POST['city'];
    $state = $_POST['userState'];
    $birthday = $_POST['birthday'];

    //Check if the user has already uploaded a profile picture
    if ($user['userImage'] !== null) {
        $file_dest = $user['userImage'];
    } else {
        $file_dest = null;
    }

    //Handle profile picture upload
    if (isset($_FILES['userImage'])) {
        $file_name = $_FILES['userImage']['name'];
        $file_tmp = $_FILES['userImage']['tmp_name'];
        $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
        $extensions = array("jpg", "jpeg", "png");

        if (in_array($file_ext, $extensions)) {
            $file_dest = "uploads/" . $username . "." . $file_ext;
            move_uploaded_file($file_tmp, $file_dest);
        }
    }

    //Update the user's information in the database
    $sql = "UPDATE user_profile SET firstName='$first_name', lastName='$last_name', email='$email', city='$city', userState='$state', birthday='$birthday', userImage='$file_dest' WHERE userDisplayName='$username'";


    //Reload the page to show the updated information
    header("Location: ?page=profile/profile");
    exit();
}

//Close the database connection
mysqli_close($conn);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Edit Profile</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <div class="form-container">
        <h2>Edit Profile</h2>
        <?php 
        if(isset($_SESSION['message'])) { 
            echo '<div class="success">' . $_SESSION['message'] . '</div>';
            unset($_SESSION['message']);
        } 
        ?>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" enctype="multipart/form-data">
          <label for="firstName">First Name:</label>
          <input type="text" id="firstName" name="firstName" value="<?php echo $user['firstName']; ?>" required>
          <label for="lastName">Last Name:</label>
          <input type="text" id="lastName" name="lastName" value="<?php echo $user['lastName']; ?>" required>
          <label for="email">Email:</label>
          <input type="email" id="email" name="email" value="<?php echo $user['email']; ?>" required>
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