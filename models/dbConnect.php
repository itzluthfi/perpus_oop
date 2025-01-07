<?php
// /laragon/www/project_akhir/model/Database.php

class Database {
    public $conn;

    // Constructor untuk membuka koneksi
    public function __construct($servername, $username, $password, $database) {
        $this->conn = mysqli_connect($servername, $username, $password, $database);
        if (!$this->conn) {
            die("Connection failed: " . mysqli_connect_error());
        }
    }

    // Fungsi untuk menjalankan query SELECT dan mengambil semua hasil dalam bentuk array asosiatif
    public function select($query) {
        $result = mysqli_query($this->conn, $query);
        if (!$result) {
            die("Query failed: " . mysqli_error($this->conn));
        }
        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }

    // Fungsi untuk menjalankan query INSERT, UPDATE, DELETE
    public function execute($query) {
        $result = mysqli_query($this->conn, $query);
        if (!$result) {
            die("Query failed: " . mysqli_error($this->conn));
        }
        return true;
    }

    // Fungsi untuk menutup koneksi
    public function close() {
        mysqli_close($this->conn);
    }
}
?>