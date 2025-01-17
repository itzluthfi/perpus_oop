<?php

require_once __DIR__ . '/dbConnect.php';
require_once __DIR__ . '../../domain_object/node_cart.php';

class ModelCart {
    private $db;
    private $carts = [];

    public function __construct() {
        // Inisialisasi koneksi database
        $this->db = Databases::getInstance();
        $this->carts = $this->getAllCartsFromDB();
    }

    public function addCart($bukuId, $userId, $jumlah) {
        $bukuId = (int)$bukuId;
        $userId = (int)$userId;
        $jumlah = (int)$jumlah;

        $query = "INSERT INTO cart (buku_id, user_id, jumlah) 
                  VALUES ($bukuId, $userId, $jumlah)";
        try {
            $this->db->execute($query);
           
            return true;
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function getAllCartsFromDB() {
        $query = "SELECT * FROM cart";
        $result = $this->db->select($query);

        $carts = [];
        foreach ($result as $row) {
            $carts[] = new NodeCart(
                $row['id'], 
                $row['buku_id'], 
                $row['user_id'], 
                $row['jumlah']
            );
        }
        return $carts;
    }

    public function getCartByUserId($userId) {
        $userId = (int)$userId;
        $query = "SELECT * FROM cart WHERE user_id = $userId";
        $result = $this->db->select($query);

        $carts = [];
        foreach ($result as $row) {
            $carts[] = new NodeCart(
                $row['id'], 
                $row['buku_id'], 
                $row['user_id'], 
                $row['jumlah']
            );
        }
        return $carts;
    }

    public function addOrUpdateCart($bukuId, $userId, $jumlah = 1) {
        $bukuId = (int)$bukuId;
        $userId = (int)$userId;
        $jumlah = (int)$jumlah;
    
        // Cek apakah item sudah ada di cart untuk user ini
        $queryCheck = "SELECT * FROM cart WHERE buku_id = $bukuId AND user_id = $userId";
        $result = $this->db->select($queryCheck);
    
        if (!empty($result)) {
            // Jika item sudah ada, update jumlahnya
            $currentJumlah = (int)$result[0]['jumlah'];
            $newJumlah = $currentJumlah + $jumlah;
            $queryUpdate = "UPDATE cart 
                            SET jumlah = $newJumlah 
                            WHERE id = {$result[0]['id']}";
    
            try {
                $this->db->execute($queryUpdate);
               
                return true;
            } catch (Exception $e) {
                return $e->getMessage();
            }
        } else {
            // Jika item belum ada, tambahkan ke cart
            return $this->addCart($bukuId, $userId, $jumlah);
        }
    }
    

    public function updateCart($id, $jumlah) {
        $id = (int)$id;
        $jumlah = (int)$jumlah;

        $query = "UPDATE cart 
                  SET jumlah = $jumlah 
                  WHERE id = $id";
        try {
            $this->db->execute($query);
            
            return true;
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }



    public function deleteCart($id) {
        $id = (int)$id;
        $query = "DELETE FROM cart WHERE id = $id";
        try {
            $this->db->execute($query);
           
            return true;
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function clearCartByUserId($userId) {
        $userId = (int)$userId;
        $query = "DELETE FROM cart WHERE user_id = $userId";
        try {
            $this->db->execute($query);

            return true;
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
}