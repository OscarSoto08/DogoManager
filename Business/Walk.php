<?php
require_once 'Business/Walker.php';
require_once 'Business/Owner.php';
require_once 'Business/Puppy.php';
require_once 'Business/Place.php';
class Walk{
    private $id;
    private $startsAt;
    private $endsAt;
    private $isAccepted;
    private $rating;
    private $puppies;
    private $owner;
    private $place;
    private $walker;

    public function __construct($id = "", $startsAt = "", $endsAt = "", $isAccepted = false, $rating = 0, $puppies = [], $owner = null, $place = null, $walker = null) {
        $this->id = $id;
        $this->startsAt = $startsAt;
        $this->endsAt = $endsAt;
        $this->isAccepted = $isAccepted;
        $this->rating = $rating;
        $this->puppies = $puppies;
        $this->owner = $owner;
        $this->place = $place;
        $this->walker = $walker;
    }

    public function getDuration() {
        $start = new DateTime($this->startsAt);
        $end = new DateTime($this->endsAt);
        return $start->diff($end)->format('%h hours %i minutes');
    }

    public function isRated() {
        return $this->rating > 0;
    }

    public function retrieve() {
        require_once 'Persistance/WalkDAO.php';
        require_once 'Persistance/Connection.php';
        require_once 'Business/Walker.php';
        require_once 'Business/Place.php';
        require_once 'Business/Puppy.php';
        require_once 'Business/Breed.php';

        $dao = new WalkDAO($this->id);
        $connection = new Connection();
        $connection->open();

        // 1) Cargar datos base + place_name
        $connection->query($dao->retrieve());
        $row = $connection->fetch_row();
        if ($row) {
            $this->startsAt   = $row[0];
            $this->endsAt     = $row[1];
            $this->isAccepted = $row[2];
            $this->rating     = $row[3];

            // Walker
            $this->walker = new Walker($row[4]);
            $this->walker->retrieve();

            // Place con ID y nombre
            $this->place = new Place($row[5], $row[6]);
        }

        // 2) Cargar cachorros
        $connection->query($dao->getPuppiesForWalk());
        $puppies = [];
        while ($p = $connection->fetch_row()) {
            $puppy = new Puppy(
                $p[0],              // id
                $p[1],              // breed_name como "nombre"
                $p[3],              // owned_by
                new Breed($p[4]),   // objeto Breed
                $p[2]               // birth_date
            );
            $puppies[] = $puppy;
        }
        $this->puppies = $puppies;

        $connection->close();
    }

    public function getId() {
        return $this->id;
    }
    public function getStartsAt() {
        return $this->startsAt;
    }
    public function getEndsAt() {
        return $this->endsAt;
    }
    public function isAccepted() {
        return $this->isAccepted;
    }
    public function getRating() {
        return $this->rating;
    }
    public function getpuppies() {
        return $this->puppies;
    }
    public function getOwner() {
        return $this->owner;
    }
    public function getPlace() {
        return $this->place;
    }
    public function getwalker() {
        return $this->walker;
    }

    public function setId($id) {
        $this->id = $id;
    }
    public function setStartsAt($startsAt) {
        $this->startsAt = $startsAt;
    }
    public function setEndsAt($endsAt) {
        $this->endsAt = $endsAt;
    }
    public function setIsAccepted($isAccepted) {
        $this->isAccepted = $isAccepted;
    }
    public function setRating($rating) {
        $this->rating = $rating;
    }
    public function setPuppies($puppies) {
        $this->puppies = $puppies;
    }
    public function setOwner($owner) {
        $this->owner = $owner;
    }
    public function setPlace($place) {
        $this->place = $place;
    }
    public function setwalker($walker) {
        $this->walker = $walker;
    }
}