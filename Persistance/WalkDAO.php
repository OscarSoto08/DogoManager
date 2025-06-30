<?php
class WalkDAO {
    private $id;

    public function __construct($id = "") {
        $this->id = $id;
    }

    public function retrieve() {
        return "
            SELECT 
                w.starts_at, 
                w.ends_at, 
                w.is_accepted, 
                w.rating, 
                w.id_walker,
                p.id      AS place_id,
                p.place   AS place_name
            FROM walk w
            LEFT JOIN place p ON w.idPlace = p.id
            WHERE w.id = '{$this->id}'
        ";
    }

    public function getPuppiesForWalk() {
        return "
            SELECT 
                p.id, 
                b.name        AS breed_name, 
                p.birth_date, 
                p.owned_by, 
                p.id_breed
            FROM walkpuppy wp
            INNER JOIN puppy p ON wp.puppy_id = p.id
            INNER JOIN breed b ON p.id_breed   = b.id
            WHERE wp.walk_id = '{$this->id}'
        ";
    }
}
