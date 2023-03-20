<!DOCTYPE html>
<html>
<head>
	  <title>Sign Up Page</title>
    <link rel="stylesheet" type="text/css" href="loginStyleSheet.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	  <script src="script.js"></script>
</head>
<body>
    <div class="loginFormHolder">
        <h2>Signup</h2>
        <form class ="loginForm" action="App/Models/backend.php" method="POST">
          <label for="firstName">First Name:</label>
          <input type="text" id="firstName" name="firstName" required>
          <label for="lastName">Last Name:</label>
          <input type="text" id="lastName" name="lastName" required>
          <label for="usernameDisplayName">Display Name:</label>
          <input type="text" id="usernameDisplayName" name="usernameDisplayName" required>
          <label for="userPassword">Password:</label>
          <input type="text" id="userPassword" name="userPassword" required>
          <label for="email">Email:</label>
          <input type="email" id="email" name="email" required>
          <label for="city">City:</label>
          <input type="text" id="city" name="city" required>
          <label for="userState">State:</label>
          <input type="text" id="userState" name="userState" required>
          <label for="birthday">Birthday:</label>
          <input type="date" id="birthday" name="birthday" required>
          <input type="submit" value="Submit">
        </form>
      </div>

</body>
</html>