<?php

class adminViewUserAccountController {

    public function viewUserAccounts() {
        require_once("./entity/userAccount.php");
		$userAccount = new userAccount();
        $accountArray = $userAccount->viewUserAccountDetails();

        return $accountArray;
    }

    public function viewUserAccountsExceptUserAdmin() {
        require_once("./entity/userAccount.php");
		$userAccount = new userAccount();
        $accountArray = $userAccount->viewUserAccountsExceptUserAdmin();

        return $accountArray;
    }
}