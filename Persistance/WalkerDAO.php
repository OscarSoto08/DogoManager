<?php
class WalkerDAO{
    private $id;
    private $name;
    private $lastName;
    private $email;
    private $password;
    private $profilePicture;
    private $isActive;
    private $ratePerHour;
    private $description;
    private $ratingAvg;

    public function __construct($id = "", $name = "", $lastName = "", $email = "", $password = "", $profilePicture = "", $isActive = true, $ratePerHour = 0.0, $description = "", $ratingAvg = 0.0) {
        $this->id = $id;
        $this->name = $name;
        $this->lastName = $lastName;
        $this->email = $email;
        $this->password = $password;
        $this->profilePicture = $profilePicture;
        $this->isActive = $isActive;
        $this->ratePerHour = $ratePerHour;
        $this->description = $description;
        $this->ratingAvg = $ratingAvg;
    }

    public function login(){
        return "SELECT id FROM Walker WHERE email = '{$this -> email}' AND password = '{$this -> password}'";
    }

    public function retrieve(){
        return "SELECT name, last_name, email, profile_picture, is_active, rate_per_hour, description, rating_avg FROM Walker WHERE id = '{$this -> id}'";
    }

    public function fetchAll(){
        return "SELECT id, name, last_name, email, profile_picture, is_active, rate_per_hour, description, rating_avg FROM Walker";
    }

    public function fetchAllActive() {
        return "SELECT id, name, last_name, email, profile_picture, is_active, rate_per_hour, description, rating_avg 
                FROM Walker
                WHERE is_active = 1";
    }

    public function searchActive($filter) {
        return "SELECT id, name, last_name, email, profile_picture, is_active, rate_per_hour, description, rating_avg
                FROM Walker
                WHERE is_active = 1 AND (name LIKE '%{$filter}%' OR last_name LIKE '%{$filter}%')";
    }

    public function search($filter){
        return "SELECT id, name, last_name, email, profile_picture, is_active, rate_per_hour, description, rating_avg
                FROM Walker
                WHERE name LIKE '%{$filter}%' OR last_name LIKE '%{$filter}%'";
    }

    public function updateStatus(){
        return "
        UPDATE Walker
        SET is_active = '{$this->isActive}'
        WHERE id = '{$this->id}'
        ";
    }

public function update(): string {
    return "UPDATE Walker SET
                name          = '" . $this->name . "',
                last_name     = '" . $this->lastName . "',   -- snake_case
                email         = '" . $this->email . "',
                rate_per_hour = "  . $this->ratePerHour . ", -- columna real
                description   = '" . $this->description . "'
            WHERE id = " . $this->id;
}


    public function getName() { return $this->name; }
    public function getLastName() { return $this->lastName; }
    public function getEmail() { return $this->email; }
    public function getPassword() { return $this->password; }
    public function getRatePerHour() { return $this->ratePerHour; }
    public function getDescription() { return $this->description; }


}