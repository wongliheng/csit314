<?php

class adminSuspendUserController {

    public function suspendUser($username) {
        require_once("./entity/userAccount.php");
        $userAccount = new userAccount();
        $result = $userAccount->accountSuspended($username);

        return $result;
    }
}