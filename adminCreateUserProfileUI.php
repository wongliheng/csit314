<?php
	session_start();
    include('controller/adminAddProfileController.php'); 
    include('controller/adminViewUserProfileController.php'); 
    include('controller/adminViewUserAccountController.php');

    if (!$_SESSION['loggedIn'] || $_SESSION['profile'] != "admin") {
        header("Location: loginUI.php");
    }

    $_SESSION['notification'] = "";
    $_SESSION['addProfileError'] = "";

    $adminViewProfiles = new adminViewUserProfileController();
    $profileList = $adminViewProfiles->requestViewUserProfile();

    if (isset($_POST['addProfile'])) {
		$addProfile = ($_POST['addprofile']);

		$adminAddProfile = new adminAddProfileController();
		$addProfileResult = $adminAddProfile->addProfile($addProfile);
        
        if ($addProfileResult) {
            header("Location: adminCreateUserProfileUI.php");
        }
	}
?>

<html>
    <head>
        <title>Create User Profile</title>
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
        <p>Create User Profiles</p>
    
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
        

   
    </div>
    </body>
</html>
