<?php
	session_start();
    include('controller/adminLogoutController.php');

    if (!$_SESSION['loggedIn'] || $_SESSION['profile'] != "admin") {
        header("Location: adminLoginUI.php");
    }
    

    if (isset($_POST['logOut'])) {
		$logout = new adminLogoutController();
		$logoutCheck = $logout->requestLogout();

        if ($logoutCheck) {
            header("Location: adminLoginUI.php");
            session_unset();
        }

	}
?>

<html>
    <head>
        <title>Admin Home</title>
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
                <th><a href="adminViewUserAccountUI.php">View All Users</a></th>
                <th><a href="adminSearchUserUI.php">Search For User</a></th>
                <th><a href="adminManageUsersUI.php">Manage Users</a></th>
                <th><a href="adminManageProfilesUI.php">Manage Profiles</a></th>
            </tr>
        </table>
</div>
<div class="pageContent">
        <table>
            <tr>
                <td><form method="POST">
                <button type="submit" name="logOut">Log Out</button>
                </form></td>
            </tr>
        </table>
</div>
    </body>
</html>