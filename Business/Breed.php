<?php
require_once 'Persistance/Connection.php';
require_once 'Persistance/BreedDAO.php';

class Breed {
    private $id;
    private $name;
    private $size;
    private $dao;      

    public function __construct($id = "", $name = "", $size = "") {
        $this->id   = $id;
        $this->name = $name;
        $this->size = $size;

        $this->dao  = new BreedDAO($id, $name, $size);
    }

    /* ========= GETTERS ========= */
    public function getId()   { return $this->id;   }
    public function getName() { return $this->name; }
    public function getSize() { return $this->size; }

    /* ========= SETTERS ========= */
    public function setId($id)         { $this->id = $id;   }
    public function setName($name)     { $this->name = $name; }
    public function setSize($size)     { $this->size = $size; }

    /* ========= CRUD ========= */


    public function getAll(): array {
        $conn = new Connection();
        $conn->open();

        $conn->query($this->dao->getAll());

        $breeds = [];
        while ($row = $conn->getResult()->fetch_assoc()) {
            $breeds[] = new Breed($row['id'], $row['name'], $row['size']);
        }

        $conn->close();
        return $breeds;
    }

    public function insert(): bool {
        $conn = new Connection();
        $conn->open();

        $conn->query($this->dao->insert());
        $success = $conn->affectedRows() > 0;

        $conn->close();
        return $success;
    }


    public function update(): bool {
        $conn = new Connection();
        $conn->open();

        $conn->query($this->dao->update());
        $success = $conn->affectedRows() > 0;

        $conn->close();
        return $success;
    }

    /** Desactiva la raza (soft delete) */
    public function deactivate(): bool {
        $conn = new Connection();
        $conn->open();
        $this->dao = new BreedDAO($this->id);
        $conn->query($this->dao->deactivate());
        $success = $conn->affectedRows()>0;

        $conn->close();
        return $success;
    }

}
