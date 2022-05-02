<?php

class adminUnsuspendUserController {

    public function unsuspendUser($username) {
        require_once("./entity/userAccount.php");
        $userAccount = new userAccount();
        $result = $userAccount->unsuspendUser($username);
    }
}