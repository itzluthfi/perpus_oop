<?php


require_once __DIR__ . '/dbConnect.php';
require_once __DIR__ . '../../domain_object/node_buku.php';

class modelBuku {
    private $db;
    private $bukus = [];

    public function __construct() {
        // Inisialisasi koneksi database
        $this->db = Databases::getInstance(); 
        $this->bukus = $this->getAllBukuFromDB();
    }

    public function addBuku($judul, $pengarang, $penerbit, $tahunTerbit, $stok) {
        $stok = (int)$stok;
        $tahunTerbit = (int)$tahunTerbit;

        $query = "INSERT INTO buku (judul, pengarang, penerbit, tahun_terbit, stok) 
                  VALUES ('$judul', '$pengarang', '$penerbit', $tahunTerbit, $stok)";
        try {
            $this->db->execute($query);
            // Perbarui data dalam sesi
            $this->bukus = $this->getAllBukuFromDB();
            $_SESSION['bukus'] = serialize($this->bukus);
            return true;
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function getAllBukuFromDB() {
        $query = "SELECT * FROM buku";
        $result = $this->db->select($query);

        $bukus = [];
        foreach ($result as $row) {
            $bukus[] = new NodeBuku($row['id'], $row['judul'], $row['pengarang'], $row['penerbit'], $row['tahun_terbit'], $row['stok']);
        }
        return $bukus;
    }

    public function getBukuById($buku_id) {
        $buku_id = (int)$buku_id;
        $query = "SELECT * FROM buku WHERE id = $buku_id";
        $result = $this->db->select($query);

        if (count($result) > 0) {
            $row = $result[0];
            $buku = new NodeBuku($row['id'], $row['judul'], $row['pengarang'], $row['penerbit'], $row['tahun_terbit'], $row['stok']);
            return $buku;
        }

        return null;
    }

    public function updateBuku($id, $judul, $pengarang, $penerbit, $tahunTerbit, $stok) {
        $id = (int)$id;
        $stok = (int)$stok;
        $tahunTerbit = (int)$tahunTerbit;

        $query = "UPDATE buku 
                  SET judul = '$judul', pengarang = '$pengarang', penerbit = '$penerbit', tahun_terbit = $tahunTerbit, stok = $stok 
                  WHERE id = $id";
        try {
            $this->db->execute($query);
            // Perbarui data dalam sesi
            $this->bukus = $this->getAllBukuFromDB();
            $_SESSION['bukus'] = serialize($this->bukus);
            return true;
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function deleteBuku($buku_id) {
        $buku_id = (int)$buku_id;
        $query = "DELETE FROM buku WHERE id = $buku_id";
        try {
            $this->db->execute($query);
            // Perbarui data dalam sesi
            $this->bukus = $this->getAllBukuFromDB();
            $_SESSION['bukus'] = serialize($this->bukus);
            return true;
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

}