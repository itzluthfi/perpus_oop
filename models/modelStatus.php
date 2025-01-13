<?php

require_once __DIR__ . '/dbConnect.php';
require_once __DIR__ . '../../domain_object/node_status.php';

class modelStatus {
    private $db;
    private $statuses = [];

    public function __construct() {
        // Inisialisasi koneksi database
        $this->db = Databases::getInstance();
    }

    public function addStatus($nama, $color) {
        $query = "INSERT INTO status (nama, color) 
                  VALUES ('$nama', '$color')";
        try {
            $this->db->execute($query);
        
            return true;
        } catch (Exception $e) {
            return $e->getMessage();

        }
    }

    public function getAllStatusFromDB() {
        $query = "SELECT * FROM status";
        $result = $this->db->select($query);

        $statuses = [];
        foreach ($result as $row) {
            $statuses[] = new Status($row['id'], $row['nama'], $row['color']);
        }
        return $statuses;
    }

    public function getStatusById($id) {
        $id = (int)$id;
        $query = "SELECT * FROM status WHERE id = $id";
        $result = $this->db->select($query);

        if (count($result) > 0) {
            $row = $result[0];
            $status = new Status($row['id'], $row['nama'], $row['color']);
            return $status;
        }

        return null;
    }

    public function updateStatus($id, $nama, $color) {
        $id = (int)$id;

        $query = "UPDATE status 
                  SET nama = '$nama', color = '$color' 
                  WHERE id = $id";
        try {
            $this->db->execute($query);
            return true;
        } catch (Exception $e) {
            return $e->getMessage();

        }
    }

    public function deleteStatus($id) {
        $id = (int)$id;
        $query = "DELETE FROM status WHERE id = $id";
        try {
            $this->db->execute($query);
            return true;
        } catch (Exception $e) {
                       return $e->getMessage();

        }
    }

    // public function __destruct() {
    //     // Menutup koneksi database
    //     $this->db->close();
    // }
}