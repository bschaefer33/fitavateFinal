<div class="loginFormHolder">
    <h1>Login</h1>
    <?php
        if(isset($message)) {
            echo '<div class="error">' . $message . '</div>';
        }
    ?>
    <form class ="loginForm" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>
        <input type="submit" value="Log In">
    </form>
    <div class="links">
        <a class="btn" href="?page=login/fitavatorPassReset">Forgot Password</a>
         <a class="btn" href="?page=login/signup">Sign Up</a>
    </div>
</div>