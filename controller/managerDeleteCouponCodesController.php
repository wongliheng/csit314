<?php

class managerDeleteCouponCodesController {

    public function deleteCode($pkey) {
        require_once("./entity/couponCode.php");
        $couponCode = new couponCode();
        $result = $couponCode->deleteCode($pkey);

        return $result;
    }
}