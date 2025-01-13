<?php

require_once __DIR__ . '/dbConnect.php';
require_once __DIR__ . '../../domain_object/node_user.php';

class modelUser {
    private $db;

    public function __construct() {
        // Inisialisasi koneksi database
        $this->db = Databases::getInstance(); 
        $this->initializeDefaultUsers();
    }

    public function initializeDefaultUsers() {
        // Cek apakah ada pengguna yang terdaftar di database
        if (empty($this->getAllUsers())) {
            $this->addUser("JohnDoe", "password123", 1, "081234567890");
            $this->addUser("JaneDoe", "password456", 2, "081234567891");
            $this->addUser("Alice", "password789", 3, "081234567892");
        }
    }

    public function addUser($username, $password, $role_id, $no_telp) {
        // Escape input untuk mencegah SQL Injection
        $username = mysqli_real_escape_string($this->db->conn, $username);
        $password = mysqli_real_escape_string($this->db->conn, $password);
        $role_id = (int)$role_id;
        $no_telp = mysqli_real_escape_string($this->db->conn, $no_telp);

        // Hash password sebelum disimpan
        $hashed_password = password_hash($password, PASSWORD_BCRYPT);

        $query = "INSERT INTO users (username, password, role_id, no_telp) VALUES ('$username', '$hashed_password', $role_id, '$no_telp')";
        try {
            $this->db->execute($query);
            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    public function getAllUsers() {
        $query = "SELECT * FROM users";
        $result = $this->db->select($query);

        $users = [];
        foreach ($result as $row) {
            // Membuat objek User dan menyimpannya ke array
            $users[] = new NodeUser($row['id'], $row['username'], $row['password'], $row['role_id'], $row['no_telp']);
        }

        // Simpan semua pengguna ke dalam sesi
        $_SESSION['users'] = $users;

        return $users;
    }

    public function getUserById($id) {
        $query = "SELECT * FROM users WHERE id = $id";
        $result = $this->db->select($query);

        if (count($result) > 0) {
            $row = $result[0];
            $user = new NodeUser($row['id'], $row['username'], $row['password'], $row['role_id'], $row['no_telp']);

            // Simpan ke sesi
            $_SESSION['user'] = $user;

            return $user;
        }

        return null;
    }

    public function updateUser($id, $username, $password, $role_id, $no_telp) {
        // Escape input untuk mencegah SQL Injection
        $username = mysqli_real_escape_string($this->db->conn, $username);
        $password = mysqli_real_escape_string($this->db->conn, $password);
        $role_id = (int)$role_id;
        $no_telp = mysqli_real_escape_string($this->db->conn, $no_telp);

        // Hash password sebelum disimpan
        $hashed_password = password_hash($password, PASSWORD_BCRYPT);

        $query = "UPDATE users SET username = '$username', password = '$hashed_password', role_id = $role_id, no_telp = '$no_telp' WHERE id = $id";
        try {
            $this->db->execute($query);

            // Update sesi setelah berhasil diupdate di DB
            $updatedUser = $this->getUserById($id);
            $_SESSION['user'] = $updatedUser;

            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    public function deleteUser($id) {
        $query = "DELETE FROM users WHERE id = $id";
        try {
            $this->db->execute($query);

            // Hapus dari sesi jika ada
            if (isset($_SESSION['user']) && $_SESSION['user']->id == $id) {
                unset($_SESSION['user']);
            }

            return true;
        } catch (Exception $e) {
            return false;
        }
    }

  
}

?>