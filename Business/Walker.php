<?php
require_once 'Business/Person.php';
require_once 'Persistance/WalkerDAO.php';
require_once 'Persistance/Connection.php';
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

    public function login() {
        $connection = new Connection();
        $connection->open();
        $dao = new WalkerDAO(email: $this -> email, password: $this -> password);
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
        $dao = new WalkerDAO(id: $this->id);
        $connection->query($dao->retrieve());
        $row = $connection -> fetch_row();
        $this->name = $row[0];
        $this->lastName = $row[1];
        $this->email = $row[2];
        $this->profilePicture = $row[3];
        $this->isActive = $row[4];
        $this->ratePerHour = $row[5];
        $this->description = $row[6];
        $this->ratingAvg = $row[7];
        $connection->close();
    }

    public function fetchAllWalkers() {
        $connection = new Connection();
        $connection->open();
        $dao = new WalkerDAO();
        $connection->query($dao->fetchAll());
        $walkers = [];
        while (($row = $connection->fetch_row()) != null) {
            $walker = new Walker(
                id: $row[0],
                name: $row[1],
                lastName: $row[2],
                email: $row[3],
                profilePicture: $row[4],
                isActive: $row[5],
                ratePerHour: $row[6],
                description: $row[7],
                ratingAvg: $row[8]
            );
            array_push($walkers, $walker);
        }
        $connection->close();
        return $walkers;
    }

    public function searchWalkers($filter) {
        $connection = new Connection();
        $connection->open();
        $dao = new WalkerDAO();
        $connection->query($dao->search($filter));
        $walkers = [];
        while (($row = $connection->fetch_row()) != null) {
            $walker = new Walker(
                id: $row[0],
                name: $row[1],
                lastName: $row[2],
                email: $row[3],
                profilePicture: $row[4],
                isActive: $row[5],
                ratePerHour: $row[6],
                description: $row[7],
                ratingAvg: $row[8]
            );
            array_push($walkers, $walker);
        }
        $connection->close();
        return $walkers;
    }

    public function updateStatus(){
        $conn = new Connection();
        $conn->open();

        $dao = new WalkerDAO(
            id:        $this->id,
            isActive:  $this->isActive
        );

        $conn->query($dao->updateStatus());
        $affected = $conn->affectedRows();

        $conn->close();
        return $affected > 0;
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

    public function __toString() {
        return "Walker: {$this->name} {$this->lastName}, Email: {$this->email}, Active: {$this->isActive}, Rate: {$this->ratePerHour}, Description: {$this->description}, Rating Avg: {$this->ratingAvg}";
    }

}