<?php
session_start();


class Connection {
    protected $conn;
    
    public function __construct(){
        date_default_timezone_set('Asia/Jakarta');
        $this->conn = mysqli_connect('localhost', 'root', '', 'db_perpus');
    }

    public function getConnection() {
        return $this->conn;
    }
}