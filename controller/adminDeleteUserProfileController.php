<?php

class adminDeleteUserProfileController {

    public function deleteProfile($profile) {
        require_once("./entity/profileType.php");
        $profileType = new profileType();
        $result = $profileType->deleteProfile($profile);

        return $result;
    }
}