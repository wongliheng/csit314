<?php

class managerSearchCouponCodeController {

    public function search($input) {
        require_once("./entity/couponCode.php");
		$error = false;
		
		if (empty($input)) {
			$error = true;
			$_SESSION['searchEmptyError'] = "Required. Please complete this field to continue.";
		} else {
			$_SESSION['searchEmptyError'] = "";
		}

        if (!$error) {
			$couponCode = new couponCode();
            $searchResult = $couponCode->searchCode($input);

            return $searchResult;
		}
    }
}