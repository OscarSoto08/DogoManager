<?php
require_once "Business/Owner.php";
require_once "Business/Breed.php";
class Puppy{
    private $id;
    private $name;
    private $owns_by;
    private $breed;
    private $birth_date; 

    public function __construct($id = "", $name = "", $owns_by = "", $breed = "", $birth_date = "") {
        $this->id = $id;
        $this->name = $name;
        $this->owns_by = $owns_by;
        $this->breed = $breed;
        $this->birth_date = $birth_date;
    }

    public function getAge(){
        $currentDate = new DateTime("now");
        $birthDate = new DateTime($this-> birth_date); 
        return $currentDate->diff($birthDate)->format('%y years and %m months'); 
    }

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }  

    public function getName() {
        return $this->name;
    }
    public function setName($name) {
        $this->name = $name;
    }

    public function set_owns_by($owns_by) {
        $this->owns_by = $owns_by;
    }
    public function owns_by() {
        return $this->owns_by;
    }
    public function getbreed() {
        return $this->breed;
    }
    public function setbreed($breed) {
        $this->breed = $breed;
    }
}
