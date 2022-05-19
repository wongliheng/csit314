<?php

class customerPaymentController {

    public function validatePayment ($name, $ccNo, $year, $cvc) {
        require_once("./entity/order.php");
		$error = false;
		
		if (empty($name)) {
			$error = true;
			$_SESSION['namePaymentError'] = "Required. Please complete this field to continue.";
		} else {
			$_SESSION['namePaymentError'] = "";
		}

        if (strlen($ccNo) != 16) {
			$error = true;
			$_SESSION['cardPaymentError'] = "Credit card number must be 16 digits.";
		} else {
			$_SESSION['cardPaymentError'] = "";
		}

		if (empty($year)) {
			$error = true;
			$_SESSION['yearPaymentError'] = "Required. Please complete this field to continue.";
		} else {
			$_SESSION['yearPaymentError'] = "";
		}

        if (strlen($cvc) != 3) {
			$error = true;
			$_SESSION['cvcPaymentError'] = "CVC must be 3 digits.";
		} else {
			$_SESSION['cvcPaymentError'] = "";
		}

        if (!$error) {
			$order = new Order();
            $paymentResult = $order->submitPayment($name, $ccNo, $year, $cvc);

            return $paymentResult;
		}
    }
}