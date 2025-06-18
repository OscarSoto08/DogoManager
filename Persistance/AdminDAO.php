<?php
class AdminDAO{
    private $id;
    private $name;
    private $lastName;
    private $email;
    private $password;

    public function __construct($id = "", $name = "", $lastName = "", $email = "", $password = "") {
        $this->id = $id;
        $this->name = $name;
        $this->lastName = $lastName;
        $this->email = $email;
        $this->password = $password;
    }

    public function login(){
        return "SELECT id FROM Admin WHERE email = '{$this -> email}' AND password = '{$this -> password}'";
    }

    public function retrieve(){
        return "SELECT name, last_name, email FROM Admin WHERE id = '{$this -> id}'";
    }
}