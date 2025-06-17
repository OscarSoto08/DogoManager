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