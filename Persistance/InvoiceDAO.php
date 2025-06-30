<?php
class InvoiceDAO {
    private $ownerId;

    public function __construct($ownerId = "") {
        $this->ownerId = $ownerId;
    }

public function getByOwnerId() {
    return "
      SELECT 
        i.id            AS invoice_id,
        i.total,
        i.created_at,
        w.id            AS walk_id
      FROM invoice i
      JOIN walk        w  ON i.id_walk    = w.id
      JOIN walkpuppy   wp ON w.id         = wp.walk_id
      JOIN puppy       p  ON wp.puppy_id  = p.id
      WHERE p.owned_by = '{$this->ownerId}'
      GROUP BY i.id
      ORDER BY i.created_at DESC
    ";
}

    public function getByWalkerId() {
        return "
            SELECT 
                i.id         AS invoice_id,
                i.total,
                i.created_at,
                w.id         AS walk_id
            FROM invoice i
            JOIN walk    w ON i.id_walk    = w.id
            WHERE w.id_walker = '{$this->ownerId}'  -- aquí ownerId será en realidad walkerId
            ORDER BY i.created_at DESC
        ";
    }



}
