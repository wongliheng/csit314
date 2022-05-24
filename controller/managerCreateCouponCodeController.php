<?php

class managerCreateCouponCodeController {

    public function createCode ($code, $discount) {
        require_once("./entity/couponCode.php");
        $error = false;
		
		if (empty($code)) {
			$error = true;
			$_SESSION['codeError'] = "Required. Please complete this field to continue.";
		} else {
			$_SESSION['codeError'] = "";
		}

        if (empty($discount)) {
			$error = true;
			$_SESSION['discountError'] = "Required. Please complete this field to continue.";
		} else {
			$_SESSION['discountError'] = "";
		}

        if (!$error) {
			$couponCode = new couponCode();
            $addCodeResult = $couponCode->createCode($code, $discount);

			return $addCodeResult;
		}
    
    }
}