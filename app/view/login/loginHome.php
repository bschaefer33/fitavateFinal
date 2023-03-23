<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['userDisplayName'];
    $password = $_POST['userPassword'];

    $conn = mysqli_connect("localhost", "root", "mysql", "fitavate");

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $sql = "SELECT * FROM user_profile WHERE userDisplayName='$username' AND userPassword='$password'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) === 1) {
        //Save the username in the session
        $_SESSION['userDisplayName'] = $username;
        //Redirect to the home page
        header("Location: ?page=home");
        exit();
    } else {
        $message = "Invalid username or password";
    }

    mysqli_close($conn);
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Login Page</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <div class="loginFormHolder">
        <h1>Login</h1>
        <?php
            if(isset($message)) {
                echo '<div class="error">' . $message . '</div>';
            }
        ?>
        <form class ="loginForm" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
            <label for="userDisplayName">Username:</label>
            <input type="text" id="userDisplayName" name="userDisplayName" required>
            <label for="userPassword">Password:</label>
            <input type="userPassword" id="userPassword" name="userPassword" required>
            <input type="submit" value="Log In">
        </form>
        <div class="links">
            <a class="btn" href="?page=login/fitavatorPassReset">Forgot Password</a>
            <a class="btn" href="?page=login/signup">Sign Up</a>
        </div>
    </div>
</body>
</html>

