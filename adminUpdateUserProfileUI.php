<?php
	session_start();
    include('controller/adminUpdateProfilesController.php');
    include('controller/adminViewUserProfileController.php'); 
    include('controller/adminViewUserAccountController.php');

    if (!$_SESSION['loggedIn'] || $_SESSION['profile'] != "admin") {
        header("Location: loginUI.php");
    }

    $_SESSION['updateProfileError'] = "";

    $adminViewProfiles = new adminViewUserProfileController();
    $profileList = $adminViewProfiles->requestViewUserProfile();

	$viewUserAccount = new adminViewUserAccountController();
	$accountArray = $viewUserAccount->viewUserAccountsExceptSelf();

    if (isset($_POST['updateUserProfile'])) {
        $username = $_POST['updateProfileUsername'];

        if (empty($_POST['updateProfile'])) {
            $updateProfile = "";
        } else {
            $updateProfile = ($_POST['updateProfile']);
        }
        $adminUpdateProfiles = new adminManageProfilesController();
		$updateProfileResult = $adminUpdateProfiles->updateUserProfile($username, $updateProfile);

        if ($updateProfileResult) {
            header("Location: adminUpdateUserProfileUI.php");
            $_SESSION['notification'] = "User profile successfully updated.";
        } else {
            $_SESSION['notification'] = "Unable to update user profile.";
        }

	}
?>

<html>
    <head>
        <title>Update User Profile</title>
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
        <p>Update User Profiles</p>
    
    <span class="error"><?php echo $_SESSION['updateProfileError'];?></span>
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
                        New Profile
                    </th>
				</tr>";
			foreach ($accountArray as $account) {
				echo  "<form method='POST'>";
                echo "<tr>
						<td>".$account['username']."</td>
                        <td>".$account['profile']."</td>";
                        echo "<td><select name='updateProfile'>";
                        echo "<option disabled selected> -- select an option -- </option>";
					        foreach ($profileList as $profile) {
						    echo "<option value='".$profile['name']."'>".$profile['name']."</option>";
					        }
                        echo "</select></td>";
							
                        echo "<td><input type='hidden' name='updateProfileUsername' value='".$account['username']."'/>
                            <input type='submit' name='updateUserProfile' value='Update'>
							</form>
						</td>
					</tr>";
                    
			}
			echo "</table>";
?>
        

   
    </div>
    </body>
</html>

<?php 
unset($_SESSION['accounts']);
?>