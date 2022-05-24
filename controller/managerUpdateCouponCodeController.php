<?php

class managerUpdateCouponCodeController {

    public function updateCode($pkey, $code, $discount) {
        require_once("./entity/couponCode.php");
		$error = false;

		if (empty($code)) {
			$error = true;
			$_SESSION['updateCodeError'] = "Required. Please complete this field to continue.";
		} else {
			$_SESSION['updateCodeError'] = "";
		}

		if (empty($discount)) {
			$error = true;
			$_SESSION['updateDiscountError'] = "Required. Please complete this field to continue.";
		} else {
			$_SESSION['updateDiscountError'] = "";
		}

        if (!$error) {
			$couponCode = new couponCode();
            $updateCodeResult = $couponCode->updateCode($pkey, $code, $discount);

			return $updateCodeResult;
		}
    }
}