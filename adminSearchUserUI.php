<?php
	session_start();
    include('controller/adminSearchUserController.php');

    if (!$_SESSION['loggedIn'] || $_SESSION['profile'] != "admin") {
        header("Location: adminLoginUI.php");
    }
    $usersFound = false;

    $_SESSION['searchUsernameError'] = "";
    $_SESSION['searchError'] = "";
    $_SESSION['accounts'] = array();

    if (isset($_POST['searchUser'])) {
		$username = ($_POST['username']);

        $searchUser = new adminSearchUserController();
		$usersFound = $searchUser->requestSearchUser($username);
	}
?>

<html>
    <head>
        <title>Search For User</title>
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
    <p>Search for a User</p>
        

    <form method="POST">
    <table>
        <tr>
            <td>Username:</td>
            <td><input type="text" name="username" placeholder="Username"></td>
            <td><span class="error"><?php echo $_SESSION['searchUsernameError'];?></span></td>
        </tr>
        <tr>
            <td><button type="submit" name="searchUser">Search</button></button></td>
            <td><span class="error"><?php echo $_SESSION['searchError'];?></span></td>
        </tr>
    </table>
    </form>
    <?php
	if ($usersFound) {
		if (!empty($_SESSION['accounts'])) {
			echo "<table>";
			echo "<tr colspan='2'>
					<th style='font-weight: bold;'>
						Username
					</th>
				</tr>";
			foreach ($_SESSION['accounts'] as $account) {
				echo "<tr>
						<td>".$account['username']."</td>
						<td>
							<form action='ViewUserAccountUI.php' method='POST'>
								<input type='hidden' name='usertest' value='".$account['username']."'/>" ."
                                <input type='submit' name='view' value='View'>
							</form>
						</td>
					</tr>";
			}
			echo "</table>";
		}
	}
?>

    </div>
    </body>
</html>