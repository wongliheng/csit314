<?php
	session_start();
    include('controller/adminCreateUserController.php');

    if (!$_SESSION['loggedIn'] || $_SESSION['profile'] != "admin") {
        header("Location: adminLoginUI.php");
    }
    
    $_SESSION['createUsernameError'] = "";
	$_SESSION['createPasswordError'] = "";
    $_SESSION['createUserError'] = "";
	$_SESSION['createUserSuccess'] = "";
    
	if (isset($_POST['createUser'])) {
		$username = ($_POST['username']);
		$password = ($_POST['password']);

        $createUser = new adminCreateUserController();
		$createdUser = $createUser->createUser($username, $password);

        if ($createdUser) {
            $_SESSION['createUserSuccess'] = "User Account Successfully Created";
        }
	}
?>

<html>
    <head>
        <title>Create User</title>
        <link rel="stylesheet" href="admin.css">
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Heebo&display=swap" rel="stylesheet">
    </head>
    <body>
    <div class="header">
        <table>
            <tr>
                <th><a href="adminPageUI.php">Home</a></th>
                <th><a href="adminCreateUserUI.php">Create User</a></th>
                <th><a href="adminSearchUserUI.php">Search For User</a></th>
            </tr>
        </table>
    </div>

    <div class="pageContent">
    <p>Creating a new User</p>
        

    <form method="POST">
    <table>
        <tr>
            <td>Username:</td>
            <td><input type="text" name="username" placeholder="Username"></td>
            <td><span class="error"><?php echo $_SESSION['createUsernameError'];?></span></td>
        </tr>
        <tr>
            <td>Password:</td>
            <td><input type="password" name="password" placeholder="Password"></td>
            <td><span class="error"><?php echo $_SESSION['createPasswordError'];?></span></td>
        </tr>
        <tr>
            <td><button type="submit" name="createUser">Create User</button></button></td>
            <td><span class="error"><?php echo $_SESSION['createUserError'];?></span></td>
        </tr>
    </table>
    </form>

    <span><?php echo $_SESSION['createUserSuccess'];?></span>
    </div>
    </body>
</html>