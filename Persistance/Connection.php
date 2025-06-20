<?php
class Connection {
    private $connection;
    private $result;

    public function open(){
        $this -> connection = new mysqli("localhost", "root", "", "dogomanager");
    }
    public function close(){
        $this -> connection->close();
        $this -> connection = null;
    }

    public function query($sql){
        $this -> result = $this -> connection -> query($sql);
    }

    public function fetch_row(): array|bool|null{
        return $this -> result -> fetch_row();
    }

    public function getResult(){
        return $this -> result;
    }

    public function rows(){
        return $this -> result -> num_rows;
    }

    public function affectedRows(){
        return $this->connection->affected_rows;
    }

}