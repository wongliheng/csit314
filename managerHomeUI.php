<?php
	session_start();
    include('controller/logoutController.php');

    if (!$_SESSION['loggedIn'] || $_SESSION['profile'] != "manager") {
        header("Location: loginUI.php");
    }
    

    if (isset($_POST['logOut'])) {
		$logoutController = new logoutController();
		$logoutCheck = $logoutController->requestLogout();

        if ($logoutCheck) {
            header("Location: loginUI.php");
            session_unset();
        }

	}
?>

<html>
    <head>
        <title>Manager Home</title>
        <link rel="stylesheet" href="admin.css">
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Heebo&display=swap" rel="stylesheet">
    </head>
    <body>
    <div class="header">
        <table>
            <tr>
                <th><a href="managerHomeUI.php">Home</a></th>
                <th><a href="managerViewMenuUI.php">View Menu</a></th>
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