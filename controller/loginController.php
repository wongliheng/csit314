<?php

class loginController {

    public function validateLogin ($username, $password) {
        require_once("./entity/userAccount.php");
        $error = false;
		$logInCheck = false;
		
		if (empty($username)) {
			$error = true;
			$_SESSION['usernameError'] = "Required. Please complete this field to continue.";
		} else {
			$_SESSION['usernameError'] = "";
		}

        if (empty($password)) {
			$error = true;
			$_SESSION['passwordError'] = "Required. Please complete this field to continue.";
		} else {
			$_SESSION['passwordError'] = "";
		}

        if (!$error) {
			$userAccount = new userAccount();
            $logInCheck = $userAccount->submitLogin($username, $password);
		}

		if ($logInCheck) {
            return true;
        } else {
            return false;
        }
        
    }
}