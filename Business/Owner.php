<?php

require_once 'Person.php';
class Owner extends Person{
    private $created_at;
    private $updated_at;

    public function __construct($id = "", $name = "", $lastName = "", $email = "", $password = "", $created_at = "", $updated_at = "") {
        parent::__construct($id, $name, $lastName, $email, $password);
        $this->created_at = $created_at;
        $this->updated_at = $updated_at;
    }


    public function getOwnedPuppies() {
        // This method should return the list of puppies owned by this owner.
        // Implementation would depend on how to manage the relationship between owners and puppies.
        return [];
    }

    public function getCreatedAt() {
        return $this->created_at;
    }
    public function setCreatedAt($created_at) {
        $this->created_at = $created_at;
    }
    public function getUpdatedAt() {
        return $this->updated_at;
    }
    public function setUpdatedAt($updated_at) {
        $this->updated_at = $updated_at;
    }
}