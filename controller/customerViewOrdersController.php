<?php

class customerViewOrdersController {

    public function requestViewOrders() {
        require_once("./entity/order.php");
		
		$order = new Order();
		$orderResult = $order->customerViewOrders();

		return $orderResult;
    }
}