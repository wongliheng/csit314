<?php

class adminSearchUserController {

    public function requestSearchUser ($username) {
        require_once("./entity/userAccount.php");
		$error = false;
        $searchUserCheck = false;
		
		if (empty($username)) {
			$error = true;
			$_SESSION['searchUsernameError'] = "Required. Please complete this field to continue.";
		} else {
			$_SESSION['searchUsernameError'] = "";
		}

        if (!$error) {
			$userAccount = new userAccount();
            $searchUserCheck = $userAccount->searchUser($username);
		}

        if ($searchUserCheck) {
            $_SESSION['searchError'] = "";
            return true;
        } else {
            return false;
        }
    }
}