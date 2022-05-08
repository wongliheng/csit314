<?php
	session_start();
    include('controller/adminLogoutController.php');

    if (!$_SESSION['loggedIn'] || $_SESSION['profile'] != "admin") {
        header("Location: adminLoginUI.php");
    }
    

    if (isset($_POST['logOut'])) {
		$logout = new adminLogoutController();
		$logoutCheck = $logout->requestLogout();

        if ($logoutCheck) {
            header("Location: adminLoginUI.php");
            // session_unset();
        }

	}
?>

<html>
<head>
  <title>Admin Home</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<style>
  .navbar{
  min-height: 50px;
  height: 50px;
} 
  </style>
<body>
<nav class="navbar navbar-light" style="background-color: #e3f2fd;">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="#">CSIT314</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li class="active"><a href="adminPageUI.php">Home</a></li>
        <li><a href="adminCreateUserUI.php">Create User</a></li>
        <li><a href="adminViewUserAccountUI.php">View All Users</a></li>
        <li><a href="adminSearchUserUI.php">Search For User</a></li>
        <li><a href="adminManageUsersUI.php">Manage Users</a></li>
        <li><a href="adminManageProfilesUI.php">Manage Profiles</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li><form method="POST">
          <button class ="btn btn-danger navbar-btn" type ="submit" name = "logOut">
          <span class="glyphicon glyphicon-log-in"></span> Log Out</a></button>
        </form>
        </li>
      </ul>
    </div>
  </div>
</nav>
<div class="pageContent">
Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
</div>
    </body>
</html>