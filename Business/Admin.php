<?php 
require_once 'Business/Person.php';
require_once 'Persistance/AdminDAO.php';

class Admin extends Person{
    public function __construct($id = "", $name = "", $lastName = "", $email = "", $password = "") {
        parent::__construct($id, $name, $lastName, $email, $password);
    }

    public function login() {
        $connection = new Connection();
        $connection->open();
        $dao = new AdminDAO(email: $this -> email, password: $this -> password);
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
        $dao = new AdminDAO(id: $this->id);
        $connection->query($dao->retrieve());
        $row = $connection -> fetch_row();
        $this->name = $row[0];
        $this->lastName = $row[1];
        $this->email = $row[2];
        $connection->close();
    }

    public function __tostring() {
        return "Admin: {$this->name} {$this->lastName}, Email: {$this->email}";
    }
}