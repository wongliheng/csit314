<?php
	session_start();

    if (!$_SESSION['loggedIn'] || $_SESSION['profile'] != "admin") {
        header("Location: loginUI.php");
    }
?>

<html>
    <head>
        <title>Manage User Profiles</title>
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


    
    <div class="profileTable">
    <table>
            <tr><td>
                <form action="adminCreateUserProfileUI.php">
                    <input type="submit" value="Create User Profiles">
                </form>
            </tr></td>
            <tr><td>
                <form action="adminUpdateUserProfileUI.php">
                    <input type="submit" value="Update User Profiles">
                </form>
            </tr></td>
            <tr><td>
                <form action="adminSearchUserProfileUI.php">
                    <input type="submit" value="Search & View User Profiles">
                </form>
            </tr></td>
            <tr><td>
                <form action="adminDeleteUserProfileUI.php">
                    <input type="submit" value="Delete User Profiles">
                </form>
            </tr></td>
    </table>
    </div>
   
    </div>
    </body>
</html>