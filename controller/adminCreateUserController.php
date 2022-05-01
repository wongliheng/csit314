<?php

class adminCreateUserController {

    public function createUser ($username, $password) {
        require_once("./entity/userAccount.php");
        $error = false;
		$createUserCheck = false;
		
		if (empty($username)) {
			$error = true;
			$_SESSION['createUsernameError'] = "Required. Please complete this field to continue.";
		} else {
			$_SESSION['createUsernameError'] = "";
		}

        if (empty($password)) {
			$error = true;
			$_SESSION['createPasswordError'] = "Required. Please complete this field to continue.";
		} else {
			$_SESSION['createPasswordError'] = "";
		}

        if (!$error) {
			$userAccount = new userAccount();
            $createUserCheck = $userAccount->createUser($username, $password);
		}

		if ($createUserCheck) {
            return true;
        } else {
            return false;
        }
        
    }
}