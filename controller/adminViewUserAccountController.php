<?php

class adminViewUserAccountController {

    public function requestViewUserAccount() {
        require_once("./entity/userAccount.php");
		$userAccount = new userAccount();
        $viewAccount = $userAccount->viewUserAccountDetails();
    }
}