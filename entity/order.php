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

        $startHour = $_SESSION['startHour'];
        $startMinute = $_SESSION['startMinute'];

        date_default_timezone_set("Asia/Singapore"); 
        $day = date("d");
        $month = date("m");
        $hour = date("H");
        $minute = date("i");
        $duration = 0;

        if ($day <= 7) {
            $week = 1;
        } else if ($day > 7 && $day <= 14) {
            $week = 2;
        } else if ($day > 14 && $day <= 21) {
            $week = 3;
        } else if ($day > 21 && $day <= 28) {
            $week = 4;
        } else {
            $week = 5;
        }        

        if ($minute > $startMinute) {
            $duration = $minute - $startMinute;
        } else {
            $duration = $minute + (60 - $startMinute);
        }
        
        if ($hour > $startHour && $minute > $startMinute) {
            $duration = $duration + (($hour - $startHour) * 60);
        } else if ($hour > $startHour && $minute < $startMinute) {
            $duration = $duration + (($hour - $startHour - 1) * 60);
        } else if ($hour = $startHour && $minute = $startMinute) {
            $duration = 1;
        }

        $status = "preparing";

        $sql = "INSERT INTO `orderDetails` (`name`, `ccNo`, `orderDetails`, `cost`, `tableCode`, `status`, `day`, `month`, `week`, `hour`, `duration`) 
        VALUES ('".$name."', '".$ccNo."', '".$orderJson."', '".$_SESSION['updatedCost']."', '".$_SESSION['tableCode']."', '".$status."'
        , '".$day."', '".$month."', '".$week."', '".$hour."', '".$duration."')";
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

    public function viewAllOrders() {
        $orders = array();
		$sql = "SELECT * FROM `orderdetails` ORDER BY orderNo DESC;";
		$result = @mysqli_query($this->conn, $sql);
		if (mysqli_num_rows($result) > 0) {
			while ($row = mysqli_fetch_assoc($result)) {
				$orders[] = $row;
			}
		}
		return $orders;
    }

    public function viewUnfulfilledOrders() {
        $orders = array();
        $status = "preparing";
		$sql = "SELECT * FROM `orderdetails` WHERE status ='".$status."' ORDER BY orderNo DESC";
		$result = @mysqli_query($this->conn, $sql);
		if (mysqli_num_rows($result) > 0) {
			while ($row = mysqli_fetch_assoc($result)) {
				$orders[] = $row;
			}
		}
		return $orders;
    }

    public function viewFulfilledOrders() {
        $orders = array();
        $status = "delivered";
		$sql = "SELECT * FROM `orderdetails` WHERE status ='".$status."' ORDER BY orderNo DESC";
		$result = @mysqli_query($this->conn, $sql);
		if (mysqli_num_rows($result) > 0) {
			while ($row = mysqli_fetch_assoc($result)) {
				$orders[] = $row;
			}
		}
		return $orders;
    }

    public function searchOrder($orderNo) {
        $order = array();
		$sql = "SELECT * FROM `orderdetails` WHERE orderNo ='".$orderNo."'";
		$result = @mysqli_query($this->conn, $sql);
		if (mysqli_num_rows($result) > 0) {
			while ($row = mysqli_fetch_assoc($result)) {
				$order[] = $row;
			}
		}
		return $order;
    }

    public function cancelOrder($orderNo) {
		$sql = "DELETE FROM orderDetails WHERE orderNo ='".$orderNo."'";
        $result = @mysqli_query($this->conn, $sql);
        if (!$result) {
            return false;
        } else {
            return true;
        }
    }

    public function orderFulfilled($orderNo) {
        $status = "delivered";
		$sql = "UPDATE `orderDetails` SET `status`='".$status."' WHERE `orderDetails`.`orderNo`='".$orderNo."'";
		$result = @mysqli_query($this->conn, $sql);
		if (!$result) {
			return false;
		} else {
			return true;
		}
	}

    public function orderUnfulfilled($orderNo) {
        $status = "preparing";
		$sql = "UPDATE `orderDetails` SET `status`='".$status."' WHERE `orderDetails`.`orderNo`='".$orderNo."'";
		$result = @mysqli_query($this->conn, $sql);
		if (!$result) {
			return false;
		} else {
			return true;
		}
	}
}