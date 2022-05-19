<?php

class customerViewOrderConfirmationController {

    public function generateOrderConfirmation() {
        require_once("./entity/order.php");
		
		$order = new Order();
		$orderConfirmation = $order->viewOrderConfirmation();

		return $orderConfirmation;
    }
}