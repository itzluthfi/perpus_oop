<?php
require_once "/laragon/www/perpus_oop/init.php";

// Check request method (POST atau GET)
if ($_SERVER['REQUEST_METHOD'] == 'POST' || $_SERVER['REQUEST_METHOD'] == 'GET') {
    // Tentukan modul dan action dari request
    $modul = isset($_POST["modul"]) ? $_POST["modul"] : $_GET["modul"];
    $action = isset($_POST["fitur"]) ? $_POST["fitur"] : $_GET["fitur"] ;

    // Arahkan setiap modul ke controller masing-masing
    switch ($modul) {
        // case 'role':
        //     require_once 'controller/ControllerRole.php';
        //     $roleController = new ControllerRole();
        //     $roleController->handleAction($action);
        //     break;

        case 'user':
            require_once 'controller/ControllerUser.php';
            $userController = new ControllerUser();
            $userController->handleAction($action);
            break;


        case 'buku':
            require_once 'controller/ControllerBuku.php';
            $bukuController = new ControllerBuku();
            $bukuController->handleAction($action);
            break;
        
        case 'peminjaman':
            require_once 'controller/ControllerPeminjaman.php';
            $peminjamanController = new ControllerPeminjaman();
            $peminjamanController->handleAction($action);
            break;
        
       
        

            case 'auth':
                switch ($action) {
                    case 'login':
                        $username = $_POST["username_login"];
                        $password = $_POST["password_login"];
                        $rememberMe = isset($_POST["remember_me"]); // Cek apakah "Remember Me" dicentang
                        $users = $modelUser->getAllUsers();
                        
                        foreach ($users as $user) {
                            // Cocokkan username dan verifikasi password
                            if ($user->user_username == $username && password_verify($password, $user->user_password)) {
                                if ($user->role_id == 1) {
                                    // Simpan ke sesi user_login
                                    $_SESSION['user_login'] = serialize($user);
                                    if ($rememberMe) {
                                        setcookie('user_login', serialize($user), time() + 86400, "/"); // 1 hari
                                    }
                                    echo "<script>alert('Login berhasil, welcome back again admin!'); window.location.href='/laundry_shoes/views/dashboard/dashboard.php';</script>";
                                } elseif ($user->role_id == 2) {
                                    // Simpan ke sesi customer_login
                                    $_SESSION['customer_login'] = serialize($user);
                                    if ($rememberMe) {
                                        setcookie('customer_login', serialize($user), time() + 86400, "/"); // 1 hari
                                    }
                                    echo "<script>alert('Login berhasil, welcome back again customer!'); window.location.href='/laundry_shoes/views/web_laundry/index.php';</script>";
                                }
                                return;
                            }
                        }
        
                        // Jika tidak ditemukan user yang cocok
                        echo "<script>alert('Login gagal'); window.location.href='/laundry_shoes/views/loginPage.php';</script>";
                        break;
        
                    case 'registrasi':
                        $username = $_POST["username_register"];
                        $password = $_POST["password_register"];
                        $no_telp = $_POST["no_telp"];
                        $role_id = $_POST["role_id"];
                        $modelUser->addUser($username, $password, $role_id, $no_telp);
                        echo "<script>alert('Registrasi berhasil'); window.location.href='/laundry_shoes/views/loginPage.php';</script>";
                        break;
                }
                break;
        
            case 'logout':
                switch ($action) {
                    case 'user':
                        // Hapus sesi user_login
                        if (isset($_SESSION['user_login'])) {
                            unset($_SESSION['user_login']);
                        }
                        // Hapus cookie jika ada
                        if (isset($_COOKIE['user_login'])) {
                            setcookie('user_login', '', time() - 3600, "/");
                        }
                        echo "<script>alert('Logout berhasil!'); window.location.href='/laundry_shoes/views/loginPage.php';</script>";
                        break;
        
                    case 'customer':
                        // Hapus sesi customer_login
                        if (isset($_SESSION['customer_login'])) {
                            unset($_SESSION['customer_login']);
                        }
                        // Hapus cookie jika ada
                        if (isset($_COOKIE['customer_login'])) {
                            setcookie('customer_login', '', time() - 3600, "/");
                        }
                        echo "<script>alert('Logout berhasil!'); window.location.href='/laundry_shoes/views/web_laundry/index.php';</script>";
                        break;
        
                    default:
                        echo "<script>alert('Logout gagal! Fitur tak dikenal'); window.location.href='/laundry_shoes/views/web_laundry/index.php';</script>";
                        break;
                }
                break;
        default:
            echo "<script>alert('Module tidak dikenal.'); window.location.href='/laundry_shoes/{$modul}/{$modul}_list.php';</script>";
            break;
    }
}


?>