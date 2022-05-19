<?php

class Order {
    function __construct() {
		include('db_connection.php');
		$this->conn = $conn;
	}

    public function customerViewOrders()  {
        return $_SESSION['cart'];
    }

    public function submitPayment($name, $ccNo, $year, $cvc) {
        $orderJson = json_encode($_SESSION['cart']);
        
        date_default_timezone_set("Asia/Singapore"); 
        $timestamp = date("Y-m-d H:i");
        $endTime = $timestamp;

        $status = "preparing";

        $sql = "INSERT INTO `orderDetails` (`name`, `ccNo`, `orderDetails`, `cost`, `startTime`, `endTime`, `tableCode`, `status`) 
        VALUES ('".$name."', '".$ccNo."', '".$orderJson."', '".$_SESSION['updatedCost']."', 
        '".$_SESSION['startTime']."', '".$endTime."', '".$_SESSION['tableCode']."', '".$status."')";
        $result = @mysqli_query($this->conn, $sql);
        
        if (!$result) {
            return false;
        } else {
            return true;
        }
	}

    public function viewOrderConfirmation() {
        $orderDetails = array();
        $sql = "SELECT * FROM orderDetails ORDER BY `orderNo` DESC LIMIT 1";
		$result = @mysqli_query($this->conn, $sql);
        if (mysqli_num_rows($result) > 0) {
			while ($row = mysqli_fetch_assoc($result)) {
				$orderDetails[] = $row;
			}
		}
		return $orderDetails;
    }

    public function applyCouponCode($code) {
        $sql = "SELECT * FROM couponCode WHERE code ='".$code."'";
		$result = @mysqli_query($this->conn, $sql);
		if (mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)) {
				$_SESSION['discount'] = $row["discount"];
			}
			$_SESSION['couponActive'] = true;
            $_SESSION['codeNotification'] = "Coupon code valid, discount will be applied on checkout.";
			return true;
		} else {
			$_SESSION['couponActive'] = false;
            $_SESSION['codeNotification'] = "Coupon code invalid.";
			return false;
		}
    }

    public function deleteOrder() {
        $_SESSION['cart'] = array();
    }
}