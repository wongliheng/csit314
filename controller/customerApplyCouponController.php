<?php

class customerApplyCouponController {

    public function applyCouponCode($code) {
        require_once("./entity/order.php");
		$error = false;
		
		if (empty($code)) {
			$error = true;
			$_SESSION['codeNotification'] = "Required. Please complete this field to continue.";
		} else {
			$_SESSION['codeNotification'] = "";
		}

        if (!$error) {
            $order = new Order();
            $couponResult = $order->applyCouponCode($code);

            return $couponResult;
		}
    }
}