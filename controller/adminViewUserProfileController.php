<?php

class adminViewUserProfileController {
    public function requestViewUserProfile() {
        require_once("./entity/profileType.php");
        $profileType = new profileType();
        $profiles = $profileType->viewProfiles();

        return $profiles;
    }
}