<?php

class userAccount {
    function __construct() {
		include('db_connection.php');
		$this->conn = $conn;
	}

    public function submitLogin ($username, $password) {
        $sql = "SELECT * FROM users WHERE username = '".$username."' AND password = '".$password."'";
		$result = @mysqli_query($this->conn, $sql);
		if(mysqli_num_rows($result) > 0){
			while($row = mysqli_fetch_assoc($result)) {
				$_SESSION['username'] = $row["username"];
				$_SESSION['profile'] = $row["profile"];
			}
            $_SESSION['loggedIn'] = true;		
			return true;
		}
		else {
			$_SESSION['logInError'] = "Login failed";
			return false;
		}
    }

	public function logOut() {
		$_SESSION['loggedIn'] = false;
		$_SESSION['profile'] = "";
		$_SESSION['username'] = "";
		return true;
	}

	public function createUser ($username, $password, $profile, $name, $email, $address) {
		$sql = "SELECT * FROM `users` WHERE username ='".$username."'";
		$result = @mysqli_query($this->conn, $sql);
		if (mysqli_num_rows($result) > 0) {
			$_SESSION['notification'] = "Username is already taken."; 
			return false;
		} else {
			$status = "active";
			$sql2 = "INSERT INTO `users` (`username`, `password`, `profile`, `name`, `email`, `address`, `status`) VALUES 
			('".$username."', '".$password."', '".$profile."', '".$name."', '".$email."', '".$address."', '".$status."')";
			$result2 = @mysqli_query($this->conn, $sql2);
			if (!$result2) {
				$_SESSION['notification'] = "Unable to create user account."; //.mysqli_error($this->conn). "\n";
				return false;
			} else {
				$_SESSION['notification'] = "User account successfully created";
				return true;
			}
		}
	}

	public function searchUser ($username) {
		$accountArray = array();
		$sql = "SELECT * FROM users WHERE (`username` LIKE '%".$username."%');";		
		$result = @mysqli_query($this->conn, $sql);
		if (mysqli_num_rows($result) > 0) {
			while ($row = mysqli_fetch_assoc($result)) {
				$accountArray[] = $row;
			}
		}
		return $accountArray;
	}

	public function viewUserAccountDetails() {
		$accountArray = array();
		$sql = "SELECT * FROM `users` ORDER BY `profile`";		
		$result = @mysqli_query($this->conn, $sql);
		if (mysqli_num_rows($result) > 0) {
			while ($row = mysqli_fetch_assoc($result)) {
				$accountArray[] = $row;
			}
		}

		return $accountArray;
	}

	public function viewUserAccountsExceptSelf() {
		$accountArray = array();
		$username = "userAdmin";
		$sql = "SELECT * FROM `users` WHERE `users`.`username` !='".$username."' ORDER BY `profile`" ;	
		$result = @mysqli_query($this->conn, $sql);
		if (mysqli_num_rows($result) > 0) {
			while ($row = mysqli_fetch_assoc($result)) {
				$accountArray[] = $row;
			}
		}

		return $accountArray;
	}


	public function updateUserDetails($username, $name, $email, $address) {
		$sql = "UPDATE `users` SET `name`='".$name."', `email`='".$email."', `address`='".$address."'
		WHERE `users`.`username`='".$username."'";
		$result = @mysqli_query($this->conn, $sql);
		if (!$result) {
			return false;
		} else {
			return true;
		}
	}

	public function suspendUser($username) {
		$status = "suspended";
		$sql = "UPDATE `users` SET `status`='".$status."'WHERE `users`.`username`='".$username."'";
		$result = @mysqli_query($this->conn, $sql);
		if (!$result) {
			$_SESSION['notification'] = "Unable to suspend user.";
			return false;
		} else {
			return true;
		}
	}

	public function unsuspendUser($username) {
		$status = "active";
		$sql = "UPDATE `users` SET `status`='".$status."'WHERE `users`.`username`='".$username."'";
		$result = @mysqli_query($this->conn, $sql);
		if (!$result) {
			$_SESSION['notification'] = "Unable to unsuspend user.";
			return false;
		} else {
			return true;
		}
	}

	public function updateProfile($username, $profile) {
		$sql = "UPDATE `users` SET `profile`='".$profile."'
		WHERE `users`.`username`='".$username."'";
		$result = @mysqli_query($this->conn, $sql);
		if (!$result) {
			return false;
		} else {
			return true;
		}
	}
}