<?php

class managerSearchMenuItemController {

    public function search($input) {
        require_once("./entity/menu.php");
		$error = false;
		
		if (empty($input)) {
			$error = true;
			$_SESSION['searchEmptyError'] = "Required. Please complete this field to continue.";
		} else {
			$_SESSION['searchEmptyError'] = "";
		}

        if (!$error) {
			$menu = new Menu();
            $searchResult = $menu->searchMenu($input);

            return $searchResult;
		}
    }
}