<?php

class adminAddProfileController {

    public function addProfile($profile) {
        require_once("./entity/profileType.php");
        $error = false;

        if (empty($profile)) {
			$error = true;
			$_SESSION['addProfileError'] = "Required.";
		} else {
			$_SESSION['addProfileError'] = "";
		}

        if (!$error) {
            $profileType = new profileType();
            $addProfile = $profileType->addProfile($profile);

            return $addProfile;
        }
    }
}