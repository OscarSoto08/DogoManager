<?php
class VerifyCodeDAO{
    private $id;
    private $code;
    private $ownerId;
    private $createdAt;
    private $expiresAt;

    public function __construct($id = "", $code = "", $ownerId = "", $createdAt = "", $expiresAt = "") {
        $this->id = $id;
        $this->code = $code;
        $this->ownerId = $ownerId;
        $this->createdAt = $createdAt;
        $this->expiresAt = $expiresAt;
    }

    public function insert(){
        return "INSERT INTO verify_code (code, user_id) VALUES ('{$this->code}', '{$this->ownerId}')";
    }

    public function retrieve(){
        return "SELECT code, owner_id, created_at, expires_at FROM verify_code WHERE user_id = '{$this->id}'";
    }

    public function delete(){
        return "DELETE FROM verify_code WHERE id = '{$this->id}'";
    }
}