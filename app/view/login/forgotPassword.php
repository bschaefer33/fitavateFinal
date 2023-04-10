<?php
session_start();
//connect to the database
$conn = mysqli_connect("localhost", "root", "mysql", "fitavate");

//check if form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  //get form data
  $email = mysqli_real_escape_string($conn, $_POST['email']);
  $security_answer = mysqli_real_escape_string($conn, $_POST['security_answer']);
  $new_password = mysqli_real_escape_string($conn, $_POST['userPassword']);

  //check if email and security answer match in database
  $query = "SELECT * FROM user_profile WHERE email = '$email' AND security_answer = '$security_answer'";
  $result = mysqli_query($conn, $query);

  if (mysqli_num_rows($result) == 1) {
    //update user's password
    $query = "UPDATE user_profile SET userPassword = '$new_password' WHERE email = '$email'";
    mysqli_query($conn, $query);

    //display success message
    echo "<p>Password changed successfully!</p>";
  } else {
    //display error message
    echo "<p>Invalid username or security answer.</p>";
  }
}

mysqli_close($conn);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="loginStyleSheet.css">
    <title>Fitavate</title>
</head>
<body>
    <div class="loginFormHolder">
        <h1>Forgot Password</h1>
        <form method="POST">
            <label for="email">Email:</label>
            <input type="text" name="email" id="email" required>
            <label for="security_question">Security Question:</label>
            <select name="security_question" required>
            <option value="What is your favorite color?">What is your favorite color?</option>
            <option value="What is your mother's maiden name?">What is your mother's maiden name?</option>
            <option value="What is your middle name?">What is your middle name?</option>
            </select>
            <label for="security_answer">Security Answer:</label>
            <input type="text" id="security_answer" name="security_answer" required>
            <label for="userPassword">New Password:</label>
            <input type="password" id="userPassword" name="userPassword" required>
            <button type="submit">Submit</button>
        </form>
    </div>
</body>
</html>
