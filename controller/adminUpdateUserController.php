<?php

class adminUpdateUserController {

    public function updateUserDetails($username, $name, $email, $address) {
        require_once("./entity/userAccount.php");
		$error = false;

		if (empty($name)) {
			$error = true;
			$_SESSION['updateNameError'] = "Required. Please complete this field to continue.";
		} else {
			$_SESSION['updateNameError'] = "";
		}

		if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
			$error = true;
			$_SESSION['updateEmailError'] = "Required. Please enter a valid email.";
		} else {
			$_SESSION['updateEmailError'] = "";
		}

		if (empty($address)) {
			$error = true;
			$_SESSION['updateAddressError'] = "Required. Please complete this field to continue.";
		} else {
			$_SESSION['updateAddressError'] = "";
		}

        if (!$error) {
			$userAccount = new userAccount();
            $updateUserResult = $userAccount->updateUserDetails($username, $name, $email, $address);

			return $updateUserResult;
		}
    }
}