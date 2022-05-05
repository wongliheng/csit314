<?php

class profileType {
    function __construct() {
		include('db_connection.php');
		$this->conn = $conn;
	}

    public function addProfile($profile) {
        $sql = "INSERT INTO `profiles` (`name`) VALUES ('".$profile."')";
        $result = @mysqli_query($this->conn, $sql);
        if (!$result) {
            $_SESSION['notification'] = "Unable to add profile.";
            return false;
        } else {
            return true;
        }
    }

    public function viewProfiles() {
		$profiles = array();
		$sql = "SELECT * FROM profiles";
		$result = @mysqli_query($this->conn, $sql);
		
		if (mysqli_num_rows($result) > 0) {
			while ($row = mysqli_fetch_assoc($result)) {
				$profiles[] = $row;
			}
		}
		return $profiles;
	}
}