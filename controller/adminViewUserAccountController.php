<?php

class adminViewUserAccountController {

    public function viewUserAccounts() {
        require_once("./entity/userAccount.php");
		$userAccount = new userAccount();
        $accountArray = $userAccount->viewUserAccountDetails();

        return $accountArray;
    }

    public function viewUserAccountsExceptSelf() {
        require_once("./entity/userAccount.php");
		$userAccount = new userAccount();
        $accountArray = $userAccount->viewUserAccountsExceptSelf();

        return $accountArray;
    }
}