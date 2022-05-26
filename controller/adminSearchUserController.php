<?php

class adminSearchUserController {

    public function searchUser ($username) {
        require_once("./entity/userAccount.php");
		$error = false;
		
		if (empty($username)) {
			$error = true;
			$_SESSION['searchUsernameError'] = "Required. Please complete this field to continue.";
		} else {
			$_SESSION['searchUsernameError'] = "";
		}

        if (!$error) {
			$userAccount = new userAccount();
            $accountArray = $userAccount->searchUser($username);

            return $accountArray;
		}
    }
}