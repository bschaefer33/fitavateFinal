<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['userPassword'];

    $conn = mysqli_connect("localhost", "root", "mysql", "fitavate");

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $sql = "SELECT * FROM user_profile WHERE email='$email' AND userPassword='$password'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) === 1) {
        //Save the username in the session
        $_SESSION['email'] = $email;
        $_SESSION['userPassword'] = $password;
        //Set user id variables-Brittany
        $row = $result->fetch_assoc();
        $_SESSION['user_id'] = $row['user_id'];
        $_SESSION['userDisplayName'] = $row['userDisplayName'];
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
<html lang="en">
<head>
    <title>Login</title>
</head>
<body>
    <div class="container-fluid p-0 m-0 loginFormHolder">
        <h1>Login</h1>
        <?php
            if (isset($message)) {
                echo '<div class="error">' . $message . '</div>';
            }
        ?>
        <form class ="loginForm" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
            <label for="email">Email:</label>
            <input type="text" id="email" name="email" required>
            <label for="userPassword">Password:</label>
            <input type="password" id="userPassword" name="userPassword" required>
            <input type="submit" value="Log In">
        </form>
        <div class="links">
            <a class="btn" href="?page=login/fitavatorPassReset">Forgot Password</a>
            <a class="btn" href="?page=login/signup">Sign Up</a>
        </div>
    </div>
</body>
</html>

