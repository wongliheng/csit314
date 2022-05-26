<?php

class adminUpdateProfileController {

    public function updateUserProfile($username, $profile) {
        require_once("./entity/userAccount.php");
        $error = false;

        if (empty($profile)) {
			$error = true;
			$_SESSION['updateProfileError'] = "Select a profile.";
            return false;
		} else {
			$_SESSION['updateProfileError'] = "";
		}

        if(!$error) {
            $userAccount = new userAccount();
            $updateProfile = $userAccount->updateProfile($username, $profile);

            return $updateProfile;
        }
    }
        
}