<?php

class Order {
    function __construct() {
		include('db_connection.php');
		$this->conn = $conn;
	}

    public function submitPayment($name, $ccNo, $year, $cvc) {
        $orderJson = json_encode($_SESSION['cart']);
        
        date_default_timezone_set("Asia/Singapore"); 
        $timestamp = date("Y-m-d H:i");
        $endTime = $timestamp;

        $status = "preparing";

        $sql = "INSERT INTO `orderDetails` (`name`, `ccNo`, `orderDetails`, `cost`, `startTime`, `endTime`, `tableCode`, `status`) 
        VALUES ('".$name."', '".$ccNo."', '".$orderJson."', '".$_SESSION['totalCost']."', 
        '".$_SESSION['startTime']."', '".$endTime."', '".$_SESSION['tableCode']."', '".$status."')";
        $result = @mysqli_query($this->conn, $sql);
        
        if (!$result) {
            return false;
        } else {
            return true;
        }
	}
}