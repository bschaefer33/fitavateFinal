<<<<<<< Updated upstream:app/model/login/signup.php
<?php
// Start the session
session_start();

// Check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get form data
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $userDisplayName = $_POST['userDisplayName'];
    $userPassword = $_POST['userPassword'];
    $email = $_POST['email'];
    $city = $_POST['city'];
    $userState = $_POST['userState'];
    $birthday = $_POST['birthday'];

    // Create a connection to the database
    $conn = mysqli_connect("localhost", "root", "mysql", "fitavate");

    // Check the connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Insert the user's information into the database
    $sql = "INSERT INTO user_profile(userDisplayName, email, userPassword, firstName, lastName, birthday, city, userState)
            VALUES ('$userDisplayName', '$email', '$userPassword', '$firstName', '$lastName, '$birthday', '$city', '$userState')";
    //$sql = "INSERT INTO users (first_name, last_name, username, password, email, city, state, birthday) 
      //      VALUES ('$first_name', '$last_name', '$username', '$password', '$email', '$city', '$state', '$birthday')";

    if (mysqli_query($conn, $sql)) {
        // Save a success message in the session
        $_SESSION['message'] = "User created successfully";
    } else {
        // Save an error message in the session
        $_SESSION['message'] = "Error creating user: " . mysqli_error($conn);
    }

    // Close the database connection
    mysqli_close($conn);
}

// Redirect the user back to the signup page
header("Location: signup.php");
exit();
?>
=======
<?php
// Start the session
session_start();

// Check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get form data
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $userDisplayName = $_POST['userDisplayName'];
    $userPassword = $_POST['userPassword'];
    $email = $_POST['email'];
    $city = $_POST['city'];
    $userState = $_POST['userState'];
    $birthday = $_POST['birthday'];

    // Create a connection to the database
    $conn = mysqli_connect("localhost", "root", "mysql", "fitavate");

    // Check the connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Insert the user's information into the database
    $sql = "INSERT INTO user_profile (userDisplayName, email, userPassword, firstName, lastName, birthday, city, userState)
            VALUES ('$userDisplayName', '$email', '$userPassword', '$firstName', '$lastName', '$birthday', '$city', '$userState')";
    //$sql = "INSERT INTO users (first_name, last_name, username, password, email, city, state, birthday)
      //      VALUES ('$first_name', '$last_name', '$username', '$password', '$email', '$city', '$state', '$birthday')";

    if (mysqli_query($conn, $sql)) {
        // Save a success message in the session
        $_SESSION['message'] = "User created successfully";
    } else {
        // Save an error message in the session
        $_SESSION['message'] = "Error creating user: " . mysqli_error($conn);
    }

    // Close the database connection
    mysqli_close($conn);
}

// Redirect the user back to the signup page
header("Location: ?page=login/loginHome");
exit();
?>
>>>>>>> Stashed changes:app/model/login/backend.php
