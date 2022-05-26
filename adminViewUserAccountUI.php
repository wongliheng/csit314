<?php
	session_start();
    include('controller/adminViewUserAccountController.php');

    if (!$_SESSION['loggedIn'] || $_SESSION['profile'] != "admin") {
        header("Location: loginUI.php");
    }

	$viewUserAccount = new adminViewUserAccountController();
	$accountArray = $viewUserAccount->viewUserAccounts();
?>

<html>
    <head>
        <title>View User</title>
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
    <p>View a list of Users</p>
        

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
						Name
					</th>
                    <th>
						Email
					</th>
                    <th>
						Address
					</th>
				</tr>";
			foreach ($accountArray as $account) {
				echo "<tr>
						<td>".$account['username']."</td>
                        <td>".$account['profile']."</td>
                        <td>".$account['name']."</td>
                        <td>".$account['email']."</td>
                        <td>".$account['address']."</td>
						<td>
							<form action='adminUpdateUserUI.php' method='POST'>
								<input type='hidden' name='updateUsername' value='".$account['username']."'/>
                                <input type='hidden' name='updatePassword' value='".$account['password']."'/>
                                <input type='hidden' name='updateName' value='".$account['name']."'/>
                                <input type='hidden' name='updateEmail' value='".$account['email']."'/>
                                <input type='hidden' name='updateAddress' value='".$account['address']."'/>
                                <input type='submit' name='update' value='Update'>
							</form>
						</td>
					</tr>";
			}
			echo "</table>";
?>
    </div>
    </body>
</html>