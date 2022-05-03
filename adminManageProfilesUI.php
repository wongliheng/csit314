<?php
	session_start();
    include('controller/adminManageProfilesController.php');
    include('controller/adminViewUserAccountController.php'); 

    if (!$_SESSION['loggedIn'] || $_SESSION['profile'] != "admin") {
        header("Location: adminLoginUI.php");
    }

    $_SESSION['addProfileError'] = "";
    $_SESSION['updateProfileError'] = "";

    $adminManageProfiles = new adminManageProfilesController();
    $profileList = $adminManageProfiles->getProfiles();

    if (isset($_POST['addProfile'])) {
		$addProfile = ($_POST['addprofile']);
		
		$addProfileResult = $adminManageProfiles->addProfile($addProfile);
        
        if ($addProfileResult) {
            header("Location: adminManageProfilesUI.php");
        }
	}


    $_SESSION['accounts'] = array();
	$viewUserAccount = new adminViewUserAccountController();
	$viewUserAccount->viewUserAccounts();

    if (isset($_POST['updateUserProfile'])) {
        $username = $_POST['updateProfileUsername'];

        if (empty($_POST['updateProfile'])) {
            $updateProfile = "";
        } else {
            $updateProfile = ($_POST['updateProfile']);
        }
		$updateProfileResult = $adminManageProfiles->updateUserProfile($username, $updateProfile);

        if ($updateProfileResult) {
            header("Location: adminManageProfilesUI.php");
            $_SESSION['notification'] = "User profile successfully updated.";
        } else {
            $_SESSION['notification'] = "Unable to update user profile.";
        }

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
                <th><a href="adminViewUserAccountUI.php">View All Users</a></th>
                <th><a href="adminSearchUserUI.php">Search For User</a></th>
                <th><a href="adminManageUsersUI.php">Manage Users</a></th>
                <th><a href="adminManageProfilesUI.php">Manage Profiles</a></th>
            </tr>
        </table>
    </div>

    <div class="pageContent">
    <p>Add new profiles or reassign user profiles</p>
    
    <?php 
    echo "<table>";
    echo "<tr>
            <th>
                Current list of profiles
            </th>
        </tr>";
        foreach ($profileList as $profile) {
        echo "<tr>
                <td> - ".$profile['name']."</td>
            </tr>";
    }
	echo "</table>";
    ?>
    <br>
    <table>
        <tr>
            <td>
                Add New Profile
            </td>
        </tr>
        <form method="POST">
        <tr>
            <td>
				Profile:
				<input type="text" name="addprofile" placeholder="Profile"/>
                <span class="error"><?php echo $_SESSION['addProfileError']; ?></span>
            </td>
        </tr>
        <tr>
            <td>
                <button type="submit" name="addProfile">Add Profile</button>
            </td>
        </tr>
        </form>
    </table>
    <br>
    <span><?php echo $_SESSION['notification'];?></span>
    <br>
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
			foreach ($_SESSION['accounts'] as $account) {
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