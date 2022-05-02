<?php

class adminCreateUserController {

    public function createUser ($username, $password, $profile, $name, $email, $address) {
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

		if (empty($name)) {
			$error = true;
			$_SESSION['createNameError'] = "Required. Please complete this field to continue.";
		} else {
			$_SESSION['createNameError'] = "";
		}

		if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
			$error = true;
			$_SESSION['createEmailError'] = "Required. Please enter a valid email.";
		} else {
			$_SESSION['createEmailError'] = "";
		}

		if (empty($address)) {
			$error = true;
			$_SESSION['createAddressError'] = "Required. Please complete this field to continue.";
		} else {
			$_SESSION['createAddressError'] = "";
		}

        if (!$error) {
			$userAccount = new userAccount();
            $createUserCheck = $userAccount->createUser($username, $password, $profile, $name, $email, $address);
		}

		if ($createUserCheck) {
            return true;
        } else {
            return false;
        }
        
    }
}