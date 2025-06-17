<?php
class Breed{
    private $id;
    private $name;
    private $size;

    public function __construct($id = "", $name = "", $size = "") {
        $this->id = $id;
        $this->name = $name;
        $this->size = $size;
    }
    public function getId() {
        return $this->id;
    }
    public function getName() {
        return $this->name;
    }
    public function getSize() {
        return $this->size;
    }


    public function setId($id) {
        $this->id = $id;
    }
    public function setName($name) {
        $this->name = $name;
    }
    public function setSize($size) {
        $this->size = $size;
    }
}