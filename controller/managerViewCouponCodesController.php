<?php

class managerViewCouponCodesController {

    public function requestCouponCodes() {
        require_once("./entity/couponCode.php");
		
		$couponCode = new couponCode();
		$couponCodes = $couponCode->viewCouponCodes();

		return $couponCodes;
    }
}