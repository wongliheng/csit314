<?php

class customerDeleteOrderController {

    public function deleteOrder() {
        require_once("./entity/order.php");

        $order = new Order();
        $order->deleteOrder();    
    }
}