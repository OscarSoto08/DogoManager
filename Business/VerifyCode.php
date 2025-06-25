<?php
require_once "Persistance/VerifyCodeDAO.php";
class VerifyCode{
    private $id;
    private $code;
    private $owner;
    private $created_at;
    private $expires_at;

    public function __construct($id = "", $code = "", $owner = null, $created_at = "", $expires_at = "") {
        $this->id = $id;
        $this->code = $code;
        $this->owner = $owner; // Owner should be an instance of Owner class
        $this->created_at = $created_at;
        $this->expires_at = $expires_at;
    }   

    public function insert($longitud = 6): mixed{
        $this ->code = random_int(100000, 999999); // Generate a random 6-digit code
        $connection = new Connection();
        $connection->open();
        $dao = new VerifyCodeDAO(code: $this->code, ownerId: $this->owner->getId());
        $connection->query($dao->insert());
        if (($this->id = $connection->getLastInsertId()) != null) {
            $this->created_at = date("Y-m-d H:i:s");
            $this->expires_at = date("Y-m-d H:i:s", strtotime("+0.5 hour")); // Set expiration to 1 hour from now
            $connection->close();
            return $this -> code; // Insertion successful
        }else{
            $connection->close();
            return null; // Insertion failed
        }
    }

    public function retrieve(){
        $connection = new Connection();
        $connection->open();
        $dao = new VerifyCodeDAO(id: $this->id);
        $connection->query($dao->retrieve());
        $row = $connection->fetch_row();
        $this->code = $row[0];
        $owner = new Owner(id: $row[1]);
        $owner->retrieve();
        $this->owner = $owner;
        $this->created_at = $row[2];
        $this->expires_at = $row[3];
        $connection->close();
    }

    public function getId() {
        return $this->id;
    }
    public function setId($id) {
        $this->id = $id;
    }

    public function getCode() {
        return $this->code;
    }
    public function setCode($code) {
        $this->code = $code;
    }
    public function getOwner() {
        return $this->owner;
    } 
    public function setOwner($owner) {
        $this->owner = $owner; // Owner should be an instance of Owner class
    }
    public function getCreatedAt() {
        return $this->created_at;
    }
    public function setCreatedAt($created_at) {
        $this->created_at = $created_at;
    }
    public function getExpiresAt() {
        return $this->expires_at;
    }
    public function setExpiresAt($expires_at) {
        $this->expires_at = $expires_at;
    }
}