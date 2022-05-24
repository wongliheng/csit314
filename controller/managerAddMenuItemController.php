<?php

class managerAddMenuItemController {

    public function addItem ($name, $price, $description, $image) {
        require_once("./entity/menu.php");
        $error = false;
		
		if (empty($name)) {
			$error = true;
			$_SESSION['nameError'] = "Required. Please complete this field to continue.";
		} else {
			$_SESSION['nameError'] = "";
		}

        if (empty($price)) {
			$error = true;
			$_SESSION['priceError'] = "Required. Please complete this field to continue.";
		} else {
			$_SESSION['priceError'] = "";
		}

		if (empty($description)) {
			$error = true;
			$_SESSION['descriptionError'] = "Required. Please complete this field to continue.";
		} else {
			$_SESSION['descriptionError'] = "";
		}

		if (empty($image)) {
			$error = true;
			$_SESSION['imageError'] = "Required. Please choose an image.";
		} else {
			$_SESSION['imageError'] = "";
        }

        if (!$error) {
			$menu = new Menu();
            $addItemResult = $menu->addItem($name, $price, $description, $image);

			return $addItemResult;
		}
    
    }
}