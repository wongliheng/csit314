<?php
	session_start();
    include('controller/adminViewUserAccountController.php');
    include('controller/adminSuspendUserController.php');
    include('controller/adminUnsuspendUserController.php');

    if (!$_SESSION['loggedIn'] || $_SESSION['profile'] != "admin") {
        header("Location: loginUI.php");
    }

    $_SESSION['notification'] = "";

	$viewUserAccount = new adminViewUserAccountController();
	$accountArray = $viewUserAccount->viewUserAccounts();

    if (isset($_POST['suspendUser'])) {
        $username = ($_POST['username']);

        $suspendUser = new adminSuspendUserController();
		$suspendUserResult = $suspendUser->suspendUser($username);

        if ($suspendUserResult) {
            header("Location: adminManageUsersUI.php");
        }
	} else if (isset($_POST['unsuspendUser'])) {
        $username = ($_POST['username']);

        $unsuspendUser = new adminUnsuspendUserController();
		$unsuspendUserResult = $unsuspendUser->unsuspendUser($username);

        if ($unsuspendUserResult) {
            header("Location: adminManageUsersUI.php");
        }
    }
?>

<html>
    <head>
        <title>Manage Users</title>
        <link rel="stylesheet" href="admin.css">
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Heebo&display=swap" rel="stylesheet">
    </head>
    <body>
    <div class="header">
        <table>
            <tr>
                <th><a href="adminHomeUI.php">Home</a></th>
                <th><a href="adminCreateUserUI.php">Create User</a></th>
                <th><a href="adminViewUserAccountUI.php">View All Users</a></th>
                <th><a href="adminSearchUserUI.php">Search For User</a></th>
                <th><a href="adminManageUsersUI.php">Manage Users</a></th>
                <th><a href="adminManageProfilesUI.php">Manage Profiles</a></th>
            </tr>
        </table>
    </div>

    <div class="pageContent">
    <p>Suspend or Unsuspend Users</p>
        
    <span><?php echo $_SESSION['notification']; ?></span>

    <?php
	echo "<table border= 1px solid black>";
	echo "<tr>
					<th>
						Username
					</th>
                    <th>
						Profile
					</th>
                    <th>
						Status
					</th>
				</tr>";
			foreach ($accountArray as $account) {
				echo "<tr>
						<td>".$account['username']."</td>
                        <td>".$account['profile']."</td>
                        <td>".$account['status']."</td>
						<td>
							<form method='POST'>
								<input type='hidden' name='username' value='".$account['username']."'/>";

                                if (strcmp($account['status'], "active") == 0) {
                                    echo "<input type='submit' name='suspendUser' value='Suspend'>";
                                } else {
                                    echo "<input type='submit' name='unsuspendUser' value='Unsuspend'>";
                                }
                                echo " </form>
						</td>
					</tr>";
			}
			echo "</table>";
?>
    </div>
    </body>
</html>

<?php 
unset($_SESSION['accounts'])
?>