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
		$result->close();
    }

	public function logOut() {
		$_SESSION['loggedIn'] = false;
		$_SESSION['profile'] = "";
		$_SESSION['username'] = "";
		return true;
	}

	public function createUser ($username, $password, $profile, $name, $email, $address) {
		$sql = "SELECT count(*) FROM `users` WHERE username ='".$username."'";
		$result = @mysqli_query($this->conn, $sql);
		if (!$result) {
			$_SESSION['createUserError'] = "Username is already taken.";
			return false;
		} else {
			$status = "active";
			$sql2 = "INSERT INTO `users` (`username`, `password`, `profile`, `name`, `email`, `address`, `status`) VALUES 
			('".$username."', '".$password."', '".$profile."', '".$name."', '".$email."', '".$address."', '".$status."')";
			$result2 = @mysqli_query($this->conn, $sql2);
			if (!$result2) {
				$_SESSION['createUserError'] = "Unable to add user account. " .mysqli_error($this->conn). "\n";
				return false;
			} else {
				return true;
			}
		}
	}

	public function searchUser ($username) {
		$accounts = array();
		$sql = "SELECT * FROM users WHERE (`username` LIKE '%".$username."%');";		
		$result = @mysqli_query($this->conn, $sql);
		if (mysqli_num_rows($result) > 0) {
			while ($row = mysqli_fetch_assoc($result)) {
				$accounts[] = $row;
			}
			$_SESSION['accounts'] = $accounts;
			return true;
		} else {
            $_SESSION['searchError'] = "No accounts found.";
			return false;
		}
	}

	public function viewUserAccountDetails() {
		$accounts = array();
		$sql = "SELECT * FROM `users` GROUP BY `profile`";		
		$result = @mysqli_query($this->conn, $sql);
		if (mysqli_num_rows($result) > 0) {
			while ($row = mysqli_fetch_assoc($result)) {
				$account[] = $row;
			}
			$_SESSION['accounts'] = $account;
			return true;
		} else {
			return false;
		}
	}

	public function submitEditDetails($username, $name, $email, $address) {
		$sql = "UPDATE `users` SET `name`='".$name."', `email`='".$email."', `address`='".$address."'
		 WHERE `users`.`username`='".$username."'";
		$result = @mysqli_query($this->conn, $sql);
		
		if (!$result) {
			$_SESSION['updateUserError'] = "Unable to update user account. " .mysqli_error($this->conn). "\n";
			return false;
		} else {
			return true;
		}
	}
}