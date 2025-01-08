<?php

require_once "/laragon/www/laundry_shoes/model/dbConnect.php";
require_once "/laragon/www/laundry_shoes/domain_object/node_peminjaman.php";
require_once "/laragon/www/laundry_shoes/domain_object/node_detailBuku.php";

class ModelPeminjaman {
    private $db;

    public function __construct() {
        // Inisialisasi koneksi database
        $this->db = new Database('localhost', 'root', '', 'perpustakaan');
    }

    public function addPeminjaman($user_id, $tanggal_pinjam, $tanggal_kembali, $status_id, $detailBuku) {
        $user_id = (int)$user_id;
        $status_id = (int)$status_id;

        $query = "INSERT INTO peminjaman (user_id, tanggal_pinjam, tanggal_kembali, status_id) 
                  VALUES ('$user_id', '$tanggal_pinjam', '$tanggal_kembali', '$status_id')";

        try {
            $this->db->execute($query);
            $peminjamanId = $this->db->conn->insert_id;

            foreach ($detailBuku as $buku) {
                $buku_id = (int)$buku['buku_id'];
                $jumlah = (int)$buku['jumlah'];

                $detailQuery = "INSERT INTO detail_buku (peminjaman_id, buku_id, jumlah) 
                                VALUES ('$peminjamanId', '$buku_id', '$jumlah')";
                $this->db->execute($detailQuery);
            }

            return true;
        } catch (Exception $e) {
            echo "<script>console.log('Error adding peminjaman: " . addslashes($e->getMessage()) . "');</script>";
            return false;
        }
    }

    public function updatePeminjamanStatus($peminjamanId, $statusId) {
        $peminjamanId = (int)$peminjamanId;
        $statusId = (int)$statusId;

        $query = "UPDATE peminjaman SET status_id = '$statusId' WHERE id = '$peminjamanId'";

        try {
            $this->db->execute($query);
            return true;
        } catch (Exception $e) {
            echo "<script>console.log('Error updating peminjaman status: " . addslashes($e->getMessage()) . "');</script>";
            return false;
        }
    }

    public function getAllPeminjaman() {
        $query = "SELECT * FROM peminjaman";
        $result = $this->db->select($query);

        $peminjamanList = [];
        foreach ($result as $row) {
            $peminjamanId = $row['id'];
            $details = $this->getDetailBukuByPeminjamanId($peminjamanId);
            $peminjamanList[] = new NodePeminjaman(
                $peminjamanId,
                $row['user_id'],
                $row['tanggal_pinjam'],
                $row['tanggal_kembali'],
                $row['status_id'],
                $details
            );
        }
        return $peminjamanList;
    }

    public function getPeminjamanById($peminjamanId) {
        $query = "SELECT * FROM peminjaman WHERE id = '$peminjamanId'";
        $result = $this->db->select($query);

        if (count($result) > 0) {
            $row = $result[0];
            $details = $this->getDetailBukuByPeminjamanId($peminjamanId);
            return new NodePeminjaman(
                $row['id'],
                $row['user_id'],
                $row['tanggal_pinjam'],
                $row['tanggal_kembali'],
                $row['status_id'],
                $details
            );
        }
        return null;
    }

    private function getDetailBukuByPeminjamanId($peminjamanId) {
        $query = "SELECT * FROM detail_buku WHERE peminjaman_id = '$peminjamanId'";
        $result = $this->db->select($query);

        $details = [];
        foreach ($result as $row) {
            $details[] = new DetailBuku(
                $row['id'],
                $row['peminjaman_id'],
                $row['buku_id'],
                $row['jumlah']
            );
        }
        return $details;
    }

    public function deletePeminjaman($peminjamanId) {
        $peminjamanId = (int)$peminjamanId;

        try {
            $this->db->execute("DELETE FROM detail_buku WHERE peminjaman_id = '$peminjamanId'");
            $this->db->execute("DELETE FROM peminjaman WHERE id = '$peminjamanId'");

            return true;
        } catch (Exception $e) {
            echo "<script>console.log('Error deleting peminjaman: " . addslashes($e->getMessage()) . "');</script>";
            return false;
        }
    }

    public function __destruct() {
        // Menutup koneksi database
        $this->db->close();
    }
}

?>