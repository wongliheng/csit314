<?php

class staffSearchOrdersController {

    public function searchOrder($orderNo) {
        require_once("./entity/order.php");
        $error = false;
		
		if (empty($orderNo)) {
			$error = true;
			$_SESSION['searchEmptyError'] = "Required. Please complete this field to continue.";
		} else {
			$_SESSION['searchEmptyError'] = "";
		}

        if (!$error) {
            $orderClass = new Order();
            $order = $orderClass->searchOrder($orderNo);

            return $order;
		}
    }
}