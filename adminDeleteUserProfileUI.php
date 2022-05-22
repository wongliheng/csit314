<?php
	session_start();
    include('controller/adminDeleteUserProfileController.php'); 
    include('controller/adminViewUserProfileController.php'); 
    include('controller/adminViewUserAccountController.php');

    if (!$_SESSION['loggedIn'] || $_SESSION['profile'] != "admin") {
        header("Location: loginUI.php");
    }

    $_SESSION['notification'] = "";
    $_SESSION['addProfileError'] = "";

    $adminViewProfiles = new adminViewUserProfileController();
    $profileList = $adminViewProfiles->requestViewUserProfile();

    if (isset($_POST['deleteProfile'])) {
		$profile = ($_POST['profile']);

		$adminDeleteProfile = new adminDeleteUserProfileController();
		$deleteProfileResult = $adminDeleteProfile->deleteProfile($profile);
        
        if ($deleteProfileResult) {
            header("Location: adminDeleteUserProfileUI.php");
        }
	}
?>

<html>
    <head>
        <title>Delete User Profile</title>
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
    
    <?php 
    echo "<table border= 1px solid black>";
    echo "<tr>
            <th colspan='2'>
                List of profiles
            </th>
        </tr>";
        foreach ($profileList as $profile) {
        echo "<tr>
                <td>".$profile['name']."</td>
                <td>
                <form method='POST'>
                    <input type='hidden' name='profile' value='".$profile['name']."'/>
                    <input type='submit' name='deleteProfile' value='Delete'>
                </form>
                </td>
            </tr>";
    }
	echo "</table>";
    ?>
        
   
    </div>
    </body>
</html>