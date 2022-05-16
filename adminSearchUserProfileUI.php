<?php
	session_start();
    include('controller/adminSearchUserProfileController.php');

    if (!$_SESSION['loggedIn'] || $_SESSION['profile'] != "admin") {
        header("Location: adminLoginUI.php");
    }

    $_SESSION['searchEmptyError'] = "";
    $_SESSION['searchError'] = "";

    if (isset($_POST['searchProfile'])) {
		$profile = ($_POST['profile']);

        $searchProfile = new adminSearchUserProfileController();
		$profileList = $searchProfile->validateSearch($profile);
        if (empty($profileList)) {
            $_SESSION['searchError'] = "No profiles found.";
        }
	}
?>

<html>
    <head>
        <title>Search User Profiles</title>
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
        <p>Search for User Profiles</p>

        <form method="POST">
    <table>
        <tr>
            <td>User Profile:</td>
            <td><input type="text" name="profile" placeholder="Profile"></td>
            <td><span class="error"><?php echo $_SESSION['searchEmptyError'];?></span></td>
        </tr>
        <tr>
            <td><button type="submit" name="searchProfile">Search</button></button></td>
            <td><span class="error"><?php echo $_SESSION['searchError'];?></span></td>
        </tr>
    </table>
    </form>
    <?php
    if (!empty($profileList)) {
        echo "<table border=1px solid black>";
        echo "<tr>
                <th>
                    Profile
                </th>
            </tr>";
        foreach ($profileList as $profile) {
            echo "<tr>
                    <td>".$profile['name']."</td>
                </tr>";
        }
        echo "</table>";
    }
?>
   
    </div>
    </body>
</html>