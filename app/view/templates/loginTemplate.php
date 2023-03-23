<!DOCTYPE html>
<html>
<head>
	<title>Login Page</title>
	<link rel="stylesheet" type="text/css" href="loginStyleSheet.css">
</head>
<body>
    <header>
    <div id="headerLogin">
        <img src="graphic/fitavate.png" alt="Logo">
    </div>
    </header>
    <div class ="container-fluid p-0 m-0" id="loginBody">
        <div class="loginLogo">
            <img src="graphic/logo.png" alt="Logo">
        </div>
        <div class ="loginContent">
            <?php
                include($main_content);
            ?>
        </div>
</body>
</html>