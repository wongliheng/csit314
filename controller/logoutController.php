<?php

class logoutController {
    public function requestLogout () {
        require_once("./entity/userAccount.php");
		
		if ($_SESSION['loggedIn']) {
			$userAccount = new userAccount();
            $logOut = $userAccount->logOut();
            return true;
		} else {
			return false;
		}
    }
}