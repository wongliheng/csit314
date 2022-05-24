<?php

class managerDeleteMenuItemController {

    public function deleteItem($name) {
        require_once("./entity/menu.php");
        $menu = new Menu();
        $result = $menu->deleteItem($name);

        return $result;
    }
}