<?php

class staffViewOrdersController {

    public function viewAllOrders() {
        require_once("./entity/order.php");
		
		$orderClass = new Order();
		$orders = $orderClass->viewAllOrders();

		return $orders;
    }

    public function viewUnfulfilledOrders() {
        require_once("./entity/order.php");
		
		$orderClass = new Order();
		$orders = $orderClass->viewUnfulfilledOrders();

		return $orders;
    }

    public function viewFulfilledOrders() {
        require_once("./entity/order.php");
		
		$orderClass = new Order();
		$orders = $orderClass->viewFulfilledOrders();

		return $orders;
    }
}