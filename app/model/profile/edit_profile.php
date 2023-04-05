<?php
session_start();

//Get the user's information from the database
$conn = mysqli_connect("localhost", "root", "mysql", "fitavate");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$email = $_SESSION['email'];
$password = $_SESSION['userPassword'];

$sql = "SELECT * FROM user_profile WHERE email='$email' AND userPassword='$password'";
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
    $new_password = $_POST['userPassword'];

    //Hash the new password
    $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

    //Check if the user has already uploaded a profile picture
    if ($user['userImage'] !== null) {
        $file_dest = $user['userImage'];
    } else {
        $file_dest = null;
    }

    //Handle profile picture upload
    if (isset($_FILES['userImage']) && $_FILES['userImage']['size'] > 0) {
        $file_tmp = $_FILES['userImage']['tmp_name'];
        $file_type = $_FILES['userImage']['type'];
        $file_data = file_get_contents($file_tmp);
        $file_size = $_FILES['userImage']['size'];
        $file_name = $_FILES['userImage']['name'];
        $file_ext = pathinfo($file_name, PATHINFO_EXTENSION);
        $allowed_exts = array("jpg", "jpeg", "png", "gif");
        $userImage = $row['userImage'];
        //Convert the binary data into a base64-encoded string
        $userImageEncoded = base64_encode($userImage);
        if (!in_array($file_ext, $allowed_exts)) {
            die("Error: Invalid file type. Only JPG, JPEG, PNG, and GIF files are allowed.");
        }
        if ($file_size > 5000000) {
            die("Error: File size cannot exceed 5MB.");
        }
        $file_dest = mysqli_real_escape_string($conn, $file_data);
    }

    //Update the user's information in the database
    $sql = "UPDATE user_profile SET firstName='$first_name', lastName='$last_name', userPassword='$hashed_password', city='$city', userState='$state', birthday='$birthday', userImage='$file_dest' WHERE email='$email'";

    if (mysqli_query($conn, $sql)) {
        echo "Record updated successfully";
    } else {
        echo "Error updating record: " . mysqli_error($conn);
    }
    //Reload the page to show the updated information
    header("Location: ?page=profile/profile");
    exit();
}

//Close the database connection
mysqli_close($conn);

?>
