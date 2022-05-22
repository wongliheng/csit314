<?php

class managerUpdateMenuController {

    public function validateUpdateDetails($name, $price, $description) {
        require_once("./entity/menu.php");
		$error = false;

		if (empty($price)) {
			$error = true;
			$_SESSION['updatePriceError'] = "Required. Please complete this field to continue.";
		} else {
			$_SESSION['updatePriceError'] = "";
		}

		if (empty($description)) {
			$error = true;
			$_SESSION['updateDescriptionError'] = "Required. Please complete this field to continue.";
		} else {
			$_SESSION['updateDescriptionError'] = "";
		}

        if (!$error) {
			$menu = new Menu();
            $updateMenuResult = $menu->updateMenuItem($name, $price, $description);

			return $updateMenuResult;
		}
    }
}