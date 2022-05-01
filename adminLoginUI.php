<?php
	session_start();
	include('controller/adminValidateLoginController.php');

    $_SESSION['loggedIn'] = false;
    $_SESSION['profile'] = "";
    $_SESSION['username'] = "";

	$_SESSION['usernameError'] = "";
	$_SESSION['passwordError'] = "";
    $_SESSION['logInError'] = "";
				
	if (isset($_POST['logIn'])) {
		$username = ($_POST['username']);
		$password = ($_POST['password']);

		$validateLogIn = new adminValidateLoginController();
		$loggedIn = $validateLogIn->validateLogin($username, $password);

        if ($loggedIn) {
            header("Location: adminPageUI.php");
        }
	}
?>
<html>
    <head>
        <title>Admin Login</title>
        <link rel="stylesheet" href="admin.css">
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Heebo&display=swap" rel="stylesheet">
    </head>

<body>
<div class="pageContent">
<form method="POST">
    <table>
        <tr>
            <td>Username:</td>
            <td><input type="text" name="username" placeholder="Username"></td>
            <td><span class="error"><?php echo $_SESSION['usernameError'];?></span></td>
        </tr>
        <tr>
            <td>Password:</td>
            <td><input type="password" name="password" placeholder="Password"></td>
            <td><span class="error"><?php echo $_SESSION['passwordError'];?></span></td>
        </tr>
        <tr>
            <td><button type="submit" name="logIn">Log In</button></td>
            <td><span class="error"><?php echo $_SESSION['logInError'];?></span></td>
        </tr>
    </table>
</form>
</div>
</body>

</html>