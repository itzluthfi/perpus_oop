<?php

require_once "/laragon/www/perpus_oop/model/dbConnect.php";
require_once "/laragon/www/perpus_oop/domain_object/node_role.php";

class modelRole {
    private $db;
    private $roles = [];

    public function __construct() {
        // Inisialisasi koneksi database
        $this->db = new Database('localhost', 'root', '', 'perpustakaan');

        if (isset($_SESSION['roles'])) {
            // Ambil data dari sesi
            $this->roles = unserialize($_SESSION['roles']);
        } else {
            // Jika sesi kosong, ambil dari database
            $this->roles = $this->getAllRoleFromDB();
            $_SESSION['roles'] = serialize($this->roles);
        }
    }

   
    public function addRole($role_nama, $role_deskripsi, $role_status) {
       
        $role_status = (int)$role_status;

        $query = "INSERT INTO roles (nama, deskripsi, status) 
                  VALUES ('$role_nama', '$role_deskripsi', $role_status)";
        try {
            $this->db->execute($query);
            // Perbarui data dalam sesi
            $this->roles = $this->getAllRoleFromDB();
            $_SESSION['roles'] = serialize($this->roles);
            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    public function getAllRoleFromDB() {
        $query = "SELECT * FROM roles";
        $result = $this->db->select($query);

        $roles = [];
        foreach ($result as $row) {
            $roles[] = new Role($row['id'], $row['nama'], $row['deskripsi'], $row['status']);
        }
        return $roles;
    }

   

    public function getRoleById($role_id) {
        $role_id = (int)$role_id;
        $query = "SELECT * FROM roles WHERE id = $role_id";
        $result = $this->db->select($query);

        if (count($result) > 0) {
            $row = $result[0];
            $role = new Role($row['id'], $row['nama'], $row['deskripsi'], $row['status']);
            return $role;
        }

        return null;
    }

    public function updateRole($id, $role_nama, $role_deskripsi, $role_status) {
        $id = (int)$id;
        $role_status = (int)$role_status;

        $query = "UPDATE roles 
                  SET nama = '$role_nama', deskripsi = '$role_deskripsi', status = $role_status 
                  WHERE id = $id";
        try {
            $this->db->execute($query);
            // Perbarui data dalam sesi
            $this->roles = $this->getAllRoleFromDB();
            $_SESSION['roles'] = serialize($this->roles);
            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    public function deleteRole($role_id) {
        $role_id = (int)$role_id;
        $query = "DELETE FROM roles WHERE id = $role_id";
        try {
            $this->db->execute($query);
            // Perbarui data dalam sesi
            $this->roles = $this->getAllRoleFromDB();
            $_SESSION['roles'] = serialize($this->roles);
            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    public function __destruct() {
        // Menutup koneksi database
        $this->db->close();
    }
}