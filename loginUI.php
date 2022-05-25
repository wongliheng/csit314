<?php
	session_start();
	include('controller/loginController.php');

    $_SESSION['loggedIn'] = false;
    $_SESSION['profile'] = "";
    $_SESSION['username'] = "";

	$_SESSION['usernameError'] = "";
	$_SESSION['passwordError'] = "";
    $_SESSION['logInError'] = "";
				
	if (isset($_POST['logIn'])) {
		$username = ($_POST['username']);
		$password = ($_POST['password']);
        $loginType = ($_POST['loginType']);

		$loginController = new loginController();
		$loggedIn = $loginController->validateLogin($username, $password);

        if ($loggedIn) {
            switch ($loginType) {
                case "admin": 
                    header("Location: adminHomeUI.php");
                    break;
                case "manager": 
                    header("Location: managerHomeUI.php");
                    break;
                case "owner": 
                    header("Location: ownerHomeUI.php");
                    break;
                case "staff": 
                    header("Location: staffHomeUI.php");
                    break;
            }
        }
	}
?>
<html>
    <head>
        <title>Login</title>
        <link rel="stylesheet" href="admin.css">
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Heebo&display=swap" rel="stylesheet">
    </head>

<body>
<div class="header">
        <table>
            <tr>
                <th><a href="customerHomeUI.php">Home</a></th>
                <th><a href="loginUI.php">Staff Login</a></th>
            </tr>
        </table>
    </div>

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
            <td>Login As:</td>
            <td><select name="loginType">
                <option value="admin">Admin</option>
                <option value="staff">Staff</option>
                <option value="manager">Manager</option>
                <option value="owner">Owner</option>
            </select></td>
        <tr>
            <td><button type="submit" name="logIn">Log In</button></td>
            <td><span class="error"><?php echo $_SESSION['logInError'];?></span></td>
        </tr>
    </table>
</form>
</div>
</body>

</html>