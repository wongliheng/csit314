<?php

class managerViewMenuController {

    public function requestViewMenu() {
        require_once("./entity/menu.php");
		
		$menu = new Menu();
		$menuItem = $menu->viewMenu();

		return $menuItem;
    }
}