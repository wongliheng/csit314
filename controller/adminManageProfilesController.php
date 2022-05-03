<?php

class adminManageProfilesController {
    public function getProfiles() {
        require_once("./entity/userAccount.php");
        $userAccount = new userAccount();
        $profiles = $userAccount->getProfiles();

        return $profiles;
    }

    public function addProfile($profile) {
        require_once("./entity/userAccount.php");
        $error = false;

        if (empty($profile)) {
			$error = true;
			$_SESSION['addProfileError'] = "Required.";
		} else {
			$_SESSION['addProfileError'] = "";
		}

        if (!$error) {
            $userAccount = new userAccount();
            $addProfile = $userAccount->addProfile($profile);

            return $addProfile;
        }
    }

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
            $addProfile = $userAccount->updateProfile($username, $profile);

            return $addProfile;
        }
    }
        
}