<?php
// config/koneksi.php

class Koneksi {
    private $host = "localhost";
    private $username = "root";
    private $password = "";
    private $database = "db_uas_pbo_trpl1b_delaapriyani";
    public $connection;

    public function __construct() {
        $this->connection = new mysqli($this->host, $this->username, $this->password, $this->database);
        
        // Cek koneksi
        if ($this->connection->connect_error) {
            die("Koneksi gagal: " . $this->connection->connect_error);
        }
    }

    public function getConnection() {
        return $this->connection;
    }

    public function closeConnection() {
        if ($this->connection) {
            $this->connection->close();
        }
    }
}
?>