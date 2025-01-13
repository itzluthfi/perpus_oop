<?php
class Databases {
    private static $instance = null;
    public $conn;

    // Constructor private untuk mencegah inisialisasi langsung
    private function __construct($servername, $username, $password, $database) {
        $this->conn = mysqli_connect($servername, $username, $password, $database);
        if (!$this->conn) {
            die("Connection failed: " . mysqli_connect_error());
        }
    }

    // Fungsi untuk mendapatkan instance tunggal
    public static function getInstance($servername = 'localhost', $username = 'root', $password = '', $database = 'perpustakaan') {
        if (self::$instance === null) {
            self::$instance = new self($servername, $username, $password, $database);
        }
        return self::$instance;
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