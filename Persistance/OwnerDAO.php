<?php
class OwnerDAO{
    private $id;
    private $name;
    private $lastName;
    private $email;
    private $password;
    private $created_at;
    private $updated_at;

    public function __construct($id = "", $name = "", $lastName = "", $email = "", $password = "", $created_at = "", $updated_at = "") {
        $this->id = $id;
        $this->name = $name;
        $this->lastName = $lastName;
        $this->email = $email;
        $this->password = $password;
        $this->created_at = $created_at;
        $this->updated_at = $updated_at;
    }

    public function login(){
        return "SELECT id FROM Owner WHERE email = '{$this -> email}' AND password = '{$this -> password}'";
    }

    public function retrieve(){
        return "SELECT name, last_name, email, created_at, updated_at FROM Owner WHERE id = '{$this -> id}'";
    }

    public function create(){
        return "INSERT INTO Owner (name, last_name, email, password, created_at) VALUES ('{$this->name}', '{$this->lastName}', '{$this->email}', '{$this->password}', '{$this->created_at}')";
    }
}