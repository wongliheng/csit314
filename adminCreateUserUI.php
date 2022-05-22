<?php
	session_start();
    include('controller/adminCreateUserController.php');
    include('controller/adminViewUserProfileController.php');

    if (!$_SESSION['loggedIn'] || $_SESSION['profile'] != "admin") {
        header("Location: loginUI.php");
    }
    
    $_SESSION['createUsernameError'] = "";
	$_SESSION['createPasswordError'] = "";
    $_SESSION['createProfileError'] = "";
    $_SESSION['createNameError'] = "";
	$_SESSION['createEmailError'] = "";
    $_SESSION['createAddressError'] = "";
    $_SESSION['notification'] = "";
    
	if (isset($_POST['createUser'])) {
		$username = ($_POST['username']);
		$password = ($_POST['password']);
        $name = ($_POST['name']);
        $email = ($_POST['email']);
        $address = ($_POST['address']);

        if (empty($_POST['profile'])) {
            $profile = "";
        } else {
            $profile = ($_POST['profile']);
        }

        $createUser = new adminCreateUserController();
		$createUser->createUserController($username, $password, $profile, $name, $email, $address);
	}
?>

<html>
    <head>
        <title>Create User</title>
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
    <p>Creating a new User</p>
        

    <form method="POST">
    <table>
        <tr>
            <td>Username:</td>
            <td><input type="text" name="username" placeholder="Username"></td>
            <td><span class="error"><?php echo $_SESSION['createUsernameError'];?></span></td>
        </tr>
        <tr>
            <td>Password:</td>
            <td><input type="password" name="password" placeholder="Password"></td>
            <td><span class="error"><?php echo $_SESSION['createPasswordError'];?></span></td>
        </tr>
        <tr>
            <td>Profile:</td>
            <td><select name="profile">
                <?php 
                    $adminViewProfiles = new adminViewUserProfileController();
                    $profileList = $adminViewProfiles->requestViewUserProfile();
					echo "<option disabled selected> -- select an option -- </option>";
					foreach ($profileList as $profile) {
						echo "<option value='".$profile['name']."'>".$profile['name']."</option>";
					}
                ?>
            </select></td>
            <td><span class="error"><?php echo $_SESSION['createProfileError'];?></span></td>
        </tr>
        <tr>
            <td>Name:</td>
            <td><input type="text" name="name" placeholder="Name"></td>
            <td><span class="error"><?php echo $_SESSION['createNameError'];?></span></td>
        </tr>
        <tr>
            <td>Email:</td>
            <td><input type="text" name="email" placeholder="Email"></td>
            <td><span class="error"><?php echo $_SESSION['createEmailError'];?></span></td>
        </tr>
        <tr>
            <td>Address:</td>
            <td><input type="text" name="address" placeholder="Address"></td>
            <td><span class="error"><?php echo $_SESSION['createAddressError'];?></span></td>
        </tr>
        <tr>
            <td><button type="submit" name="createUser">Create User</button></td>
        </tr>
    </table>
    </form>

    <span><?php echo $_SESSION['notification'];?></span>
    </div>
    </body>
</html>

<?php 
unset($_SESSION['createUsernameError']);
unset($_SESSION['createPasswordError']);
unset($_SESSION['createProfileError']);
unset($_SESSION['createNameError']);
unset($_SESSION['createEmailError']);
unset($_SESSION['createAddressError']);
unset($_SESSION['notification']);
?>