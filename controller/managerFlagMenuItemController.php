<?php

class managerFlagMenuItemController {

    public function flagItem($name, $status) {
        require_once("./entity/menu.php");
        $menu = new Menu();
        $result = $menu->flagItem($name, $status);

        return $result;
    }
}