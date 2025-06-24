<?php

require_once 'Person.php';
require_once 'Persistance/OwnerDAO.php';
class Owner extends Person{
    private $created_at;
    private $updated_at;

    public function __construct($id = "", $name = "", $lastName = "", $email = "", $password = "", $created_at = "", $updated_at = "") {
        parent::__construct($id, $name, $lastName, $email, $password);
        $this->created_at = $created_at;
        $this->updated_at = $updated_at;
    }

    public function login() {
        $connection = new Connection();
        $connection->open();
        $dao = new OwnerDAO(email: $this -> email, password: $this -> password);
        $connection->query($dao->login());
        if(($row = $connection -> fetch_row()) != null){ 
            $this -> id = $row[0];
            $connection->close();
            return true; // Login successful
        }
        $connection->close();
        return false; // Login failed
    }

    public function retrieve(){
        $connection = new Connection();
        $connection->open();
        $dao = new OwnerDAO(id: $this->id);
        $connection->query($dao->retrieve());
        $row = $connection -> fetch_row();
        $this->name = $row[0];
        $this->lastName = $row[1];
        $this->email = $row[2];
        $this->created_at = $row[3];
        $this->updated_at = $row[4];
        $connection->close();
    }

    public function create() {
        $connection = new Connection();
        $connection->open();
        $dao = new OwnerDAO(name: $this->name, lastName: $this->lastName, email: $this->email, password: $this->password, created_at: $this->created_at);
        $connection->query($dao->create());
        if (($this->id = $connection->getLastInsertId()) != null) {
            $connection->close();
            return true; // Creation successful
        }
        $connection->close();
        return false; // Creation failed
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

    public function __toString() {
        return "Owner: {$this->name} {$this->lastName}, Email: {$this->email}, Created At: {$this->created_at}, Updated At: {$this->updated_at}";
    }
}