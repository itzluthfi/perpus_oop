<?php 
require_once "./init.php";

// Cek apakah ada sesi pengguna yang aktif
if (isset($_SESSION['user_login'])) {
    // Ambil role_id dari objek user_login
    $roleId = $_SESSION['user_login']->role_id;

    // Cek role_id untuk menentukan jenis pengguna
    if ($roleId == 1) {
        // Jika role_id adalah 1, arahkan ke halaman admin/user
        header('Location: ./views/user/user_list.php');
        exit();
    } elseif ($roleId == 2) {
        // Jika role_id adalah 2, arahkan ke halaman anggota
        header('Location: ./views/index.php');
        exit();
    }
}

// Cek apakah ada cookie untuk user_login
if (isset($_COOKIE['user_login'])) {
    // Decode cookie menjadi objek
    $userLogin = unserialize($_COOKIE['user_login']);

    // Set sesi dari objek cookie
    $_SESSION['user_login'] = $userLogin;

    // Ambil role_id dari objek user_login
    $roleId = $userLogin->role_id;

    // Cek role_id untuk menentukan jenis pengguna
    if ($roleId == 1) {
        // Jika role_id adalah 1, arahkan ke halaman admin/user
        header('Location: ./views/user/user_list.php');
        exit();
    } elseif ($roleId == 2) {
        // Jika role_id adalah 2, arahkan ke halaman anggota
        header('Location: ./views/index.php');
        exit();
    }
}

// Jika tidak ada sesi atau cookie, tampilkan halaman login
die(header('Location: ./views/index.php'));