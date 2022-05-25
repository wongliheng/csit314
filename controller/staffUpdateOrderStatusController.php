<?php

class staffUpdateOrderStatusController {

    public function orderFulfilled($orderNo) {
        require_once("./entity/order.php");

        $order = new Order();
        $cancelResult = $order->orderFulfilled($orderNo);    

        return $cancelResult;
    }

    public function orderUnfulfilled($orderNo) {
        require_once("./entity/order.php");

        $order = new Order();
        $cancelResult = $order->orderUnfulfilled($orderNo);    

        return $cancelResult;
    }
}