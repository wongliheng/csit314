<?php

class staffCancelOrderController {

    public function cancelOrder($orderNo) {
        require_once("./entity/order.php");

        $order = new Order();
        $cancelResult = $order->cancelOrder($orderNo);    

        return $cancelResult;
    }
}