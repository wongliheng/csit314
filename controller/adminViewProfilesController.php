<?php

class adminViewProfilesController {
    public function viewProfiles() {
        require_once("./entity/profileType.php");
        $profileType = new profileType();
        $profiles = $profileType->viewProfiles();

        return $profiles;
    }
}