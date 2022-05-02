<?php
	session_start();
    include('controller/adminUpdateUserController.php');

    if (!$_SESSION['loggedIn'] || $_SESSION['profile'] != "admin") {
        header("Location: adminLoginUI.php");
    }

    $_SESSION['updateNameError'] = "";
	$_SESSION['updateEmailError'] = "";
    $_SESSION['updateAddressError'] = "";
    $_SESSION['notification'] = "";

    if (empty($_POST['updateUsername'])) {
        $_SESSION['updateUsername'] = $_POST['username'];
        $_SESSION['updateName'] = $_POST['updatedName'];
        $_SESSION['updateEmail'] = $_POST['updatedEmail'];
        $_SESSION['updateAddress'] = $_POST['updatedAddress'];
    } else {
        $_SESSION['updateUsername'] = $_POST['updateUsername'];
        $_SESSION['updateName'] = $_POST['updateName'];
        $_SESSION['updateEmail'] = $_POST['updateEmail'];
        $_SESSION['updateAddress'] = $_POST['updateAddress'];
    }

    if (isset($_POST['updateUser'])) {
        $name = ($_POST['updatedName']);
        $email = ($_POST['updatedEmail']);
        $address = ($_POST['updatedAddress']);

        $updateUser = new adminUpdateUserController();
		$updateUserResult = $updateUser->updateUserDetails($_SESSION['updateUsername'], $name, $email, $address);

        $_SESSION['notification'] = $updateUserResult;
	}
?>

<html>
    <head>
        <title>Update User Details</title>
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
    <p>Edit User Details</p>
        
    <form method="POST">
		<label for="name"> Name:</label>
		<input type="text" id="name" name="updatedName" value="<?php echo $_SESSION['updateName']; ?>" />
		<span><?php echo $_SESSION['updateNameError']; ?></span>
		<br>
        <label for="email"> Email:</label>
		<input type="text" id="email" name="updatedEmail" value="<?php echo $_SESSION['updateEmail']; ?>" />
		<span><?php echo $_SESSION['updateEmailError']; ?></span>
		<br>
        <label for="address"> Address:</label>
		<input type="text" id="address" name="updatedAddress" value="<?php echo $_SESSION['updateAddress']; ?>" />
		<span><?php echo $_SESSION['updateAddressError']; ?></span>
		<br>
        <input type='hidden' name='username' value="<?php echo $_SESSION['updateUsername']; ?>" />
		<input type="submit" name="updateUser" value="Update Account" />
	</form>
	<span><?php echo $_SESSION['notification']; ?></span>

    </div>
    </body>
</html>