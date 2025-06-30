<?php 
require_once "Business/Walk.php";
require_once 'Persistance/Connection.php';
require_once 'Persistance/InvoiceDAO.php';

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

public static function getByOwnerId($ownerId) {


    $dao = new InvoiceDAO($ownerId);
    $connection = new Connection();
    $connection->open();
    $connection->query($dao->getByOwnerId());

    $invoices = [];
    while ($row = $connection->getResult()->fetch_assoc()) {
        $walk = new Walk($row['walk_id']);
        $walk->retrieve();

        $invoice = new Invoice(
            $row['invoice_id'],
            $row['total'],
            $row['created_at'],
            $walk
        );
        $invoices[] = $invoice;
    }

    $connection->close();
    return $invoices;
}





public static function getByWalkerId($walkerId) {
    require_once 'Persistance/InvoiceDAO.php';
    require_once 'Persistance/Connection.php';
    require_once 'Business/Walk.php';

    $dao = new InvoiceDAO($walkerId);
    $connection = new Connection();
    $connection->open();
    $connection->query($dao->getByWalkerId());

    $invoices = [];
    while ($row = $connection->getResult()->fetch_assoc()) {
        $walk = new Walk($row['walk_id']);
        $walk->retrieve();
        $invoices[] = new Invoice(
            $row['invoice_id'],
            $row['total'],
            $row['created_at'],
            $walk
        );
    }
    $connection->close();
    return $invoices;
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