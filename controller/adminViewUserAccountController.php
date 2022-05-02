<?php

class adminViewUserAccountController {

    public function viewUserAccounts() {
        require_once("./entity/userAccount.php");
		$userAccount = new userAccount();
        $viewAccount = $userAccount->viewUserAccountDetails();
    }

    public function viewUserProfiles () {
        require_once("./entity/userAccount.php");
		$userAccount = new userAccount();
        $viewAccount = $userAccount->viewUserProfiles();
    }
}