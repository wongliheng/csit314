<?php

class couponCode {
    function __construct() {
		include('db_connection.php');
		$this->conn = $conn;
	}

    public function viewCouponCodes() {
		$codes = array();
		$sql = "SELECT * FROM couponCode";
		$result = @mysqli_query($this->conn, $sql);
		
		if (mysqli_num_rows($result) > 0) {
			while ($row = mysqli_fetch_assoc($result)) {
				$codes[] = $row;
			}
		}
		return $codes;
	}
	
	public function updateCode($pkey, $code, $discount) {
		$sql = "UPDATE `couponCode` SET `code`='".$code."', `discount`='".$discount."'
		WHERE `couponCode`.`pkey`='".$pkey."'";
		$result = @mysqli_query($this->conn, $sql);
		if (!$result) {
			return false;
		} else {
			return true;
		}
	}

	public function deleteCode($pkey) {
		$sql = "DELETE FROM couponCode WHERE pkey ='".$pkey."'";
        $result = @mysqli_query($this->conn, $sql);
        if (!$result) {
            return false;
        } else {
            return true;
        }
	}

	public function createCode($code, $discount) {
		$sql = "SELECT * FROM `couponCode` WHERE `code` ='".$code."'";
		$result = @mysqli_query($this->conn, $sql);
		if (mysqli_num_rows($result) > 0) {
			$_SESSION['notification'] = "Code already exists."; 
			return false;
		} else {
			$status = "available";
			$sql2 = "INSERT INTO `couponCode` (`code`, `discount`) VALUES 
			('".$code."', '".$discount."')";
			$result2 = @mysqli_query($this->conn, $sql2);
			if (!$result2) {
				$_SESSION['notification'] = "Unable to add coupon code."; 
				return false;
			} else {
				$_SESSION['notification'] = "Coupon code successfully added";
				return true;
			}
		}
	}

	public function searchCode($input) {
		$search = array();
		$sql = "SELECT * FROM couponCode WHERE (`code` LIKE '%".$input."%');";
		$result = @mysqli_query($this->conn, $sql);
		if (mysqli_num_rows($result) > 0) {
			while ($row = mysqli_fetch_assoc($result)) {
				$search[] = $row;
			}
		}
		return $search;
	}
}