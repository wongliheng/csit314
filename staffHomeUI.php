<?php
	session_start();
    include('controller/logoutController.php');

    if (!$_SESSION['loggedIn'] || $_SESSION['profile'] != "staff") {
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
        <title>Staff Home</title>
        <link rel="stylesheet" href="admin.css">
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Heebo&display=swap" rel="stylesheet">
    </head>
    <body>
    <div class="header">
        <table>
            <tr>
                <th><a href="staffHomeUI.php">Home</a></th>
                <th><a href="staffViewOrdersUI.php">View Orders</a></th>
                <th><a href="staffSearchOrdersUI.php">Search for Order</a></th>
                <th><a href="staffUpdateOrdersUI.php">Update Order Status</a></th>
                <th><a href="staffCancelOrdersUI.php">Cancel Orders</a></th>
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