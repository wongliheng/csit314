<?php

class tableCode {
    function __construct() {
		include('db_connection.php');
		$this->conn = $conn;
	}

    public function enterTableCode($code) {
		$sql = "SELECT * FROM `tableCode` WHERE code ='".$code."'";
		$result = @mysqli_query($this->conn, $sql);
		
		if (mysqli_num_rows($result) > 0) {
			return true;
		} else {
            $_SESSION['codeError'] = "Please ensure the code is correct.";
            return false;
        }
	}
}