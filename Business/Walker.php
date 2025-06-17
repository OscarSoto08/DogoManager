<?php
class Walker extends Person {
    private $profilePicture;
    private $isActive;
    private $ratePerHour;
    private $description;
    private $ratingAvg;

    public function __construct($id = "", $name = "", $lastName = "", $email = "", $password = "", $profilePicture = "", $isActive = true, $ratePerHour = 0.0, $description = "", $ratingAvg = 0.0) {
        parent::__construct($id, $name, $lastName, $email, $password);
        $this->profilePicture = $profilePicture;
        $this->isActive = $isActive;
        $this->ratePerHour = $ratePerHour;
        $this->description = $description;
        $this->ratingAvg = $ratingAvg;
    }

    public function calculateEarnings(){
        // This method should calculate the earnings of the walker based on their rate per hour and hours worked.
        // Implementation would depend on how to manage the relationship between walkers and their work hours.
        return 0.0; // Placeholder return value
    }


    public function getProfilePicture() {
        return $this->profilePicture;
    }
    public function isActive() {
        return $this->isActive;
    }
    public function getRatePerHour() {
        return $this->ratePerHour;
    }
    public function getDescription() {
        return $this->description;
    }
    public function getRatingAvg() {
        return $this->ratingAvg;
    }
    public function setProfilePicture($profilePicture) {
        $this->profilePicture = $profilePicture;
    }
    public function setActive($isActive) {
        $this->isActive = $isActive;
    }
    public function setRatePerHour($ratePerHour) {
        $this->ratePerHour = $ratePerHour;
    }
    public function setDescription($description) {
        $this->description = $description;
    }
    public function setRatingAvg($ratingAvg) {
        $this->ratingAvg = $ratingAvg;
    }
}