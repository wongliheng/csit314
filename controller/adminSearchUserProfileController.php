<?php

class adminSearchUserProfileController {

    public function validateSearch ($input) {
        require_once("./entity/profileType.php");
		$error = false;
		
		if (empty($input)) {
			$error = true;
			$_SESSION['searchEmptyError'] = "Required. Please complete this field to continue.";
		} else {
			$_SESSION['searchEmptyError'] = "";
		}

        if (!$error) {
			$profileType = new profileType();
            $profiles = $profileType->searchProfile($input);

            return $profiles;
		}
    }
}