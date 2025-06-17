<?php 
require_once "Business/Walk.php";
class Invoice{
    private $id;
    private $total;
    private $created_at;
    private $walk;

    public function __construct($id = "", $total = "", $created_at = "", $walk = "") {
        $this->id = $id;
        $this->total = $total;
        $this->created_at = $created_at;
        $this->walk = $walk;
    }

    public function getId() {
        return $this->id;
    }
    public function setId($id) {
        $this->id = $id;
    }
    public function getTotal() {
        return $this->total;
    }
    public function setTotal($total) {
        $this->total = $total;
    }
    public function getCreatedAt() {
        return $this->created_at;
    }
    public function setCreatedAt($created_at) {
        $this->created_at = $created_at;
    }
    public function getWalk() {
        return $this->walk;
    }
    public function setWalk($walk) {
        $this->walk = $walk;
    }
}