<?php

class BreedDAO {
    private $id;
    private $name;
    private $size;

    public function __construct($id = "", $name = "", $size = "") {
        $this->id   = $id;
        $this->name = $name;
        $this->size = $size;
    }

    /* ===== SELECT ===== */
    public function getAll(): string {
        return "SELECT id, name, size FROM Breed WHERE is_active = TRUE ORDER BY id ASC";

    }

    public function getById(): string {
        return "SELECT id, name, size FROM Breed WHERE id = '{$this->id}'";
    }

    /* ===== INSERT ===== */
    public function insert(): string {
        return "INSERT INTO Breed (name, size) VALUES ('{$this->name}', '{$this->size}')";
    }

    /* ===== UPDATE ===== */
    public function update(): string {
        return "UPDATE Breed SET name = '{$this->name}', size = '{$this->size}' WHERE id = '{$this->id}'";
    }

    /* ===== DEACTIVATE ===== */
    public function deactivate(): string {
        return "UPDATE Breed SET is_active = FALSE WHERE id = '{$this->id}'";
    }

    
}
