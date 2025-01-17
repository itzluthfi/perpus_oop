<?php
require_once __DIR__ . '/init.php';


// Check request method (POST atau GET)
if ($_SERVER['REQUEST_METHOD'] == 'POST' || $_SERVER['REQUEST_METHOD'] == 'GET') {
    // Tentukan modul dan action dari request
    $modul = isset($_POST["modul"]) ? $_POST["modul"] : $_GET["modul"];
    $action = isset($_POST["fitur"]) ? $_POST["fitur"] : $_GET["fitur"] ;

    // Arahkan setiap modul ke controller masing-masing
    switch ($modul) {
        case 'role':
            require_once 'controllers/ControllerRole.php';
            $roleController = new ControllerRole();
            $roleController->handleAction($action);
            break;

        case 'user':
            require_once 'controllers/ControllerUser.php';
            $userController = new ControllerUser();
            $userController->handleAction($action);
            break;


        case 'buku':
            require_once 'controllers/ControllerBuku.php';
            $bukuController = new ControllerBuku();
            $bukuController->handleAction($action);
            break;
        
        case 'peminjaman':
            require_once 'controllers/ControllerPeminjaman.php';
            $peminjamanController = new ControllerPeminjaman();
            $peminjamanController->handleAction($action);
            break;

        case 'cart':
            require_once 'controllers/ControllerCart.php';
            $cartController = new ControllerCart();
            $cartController->handleAction($action);
            break;

            case 'auth':
                switch ($action) {
                    case 'login':
                        $username = $_POST["username_login"];
                        $password = $_POST["password_login"];
                        $rememberMe = isset($_POST["remember_me"]); // Cek apakah "Remember Me" dicentang
                        $users = $modelUser->getAllUsers();
                        
                        foreach ($users as $user) {
                            if ($user->user_username == $username && password_verify($password, $user->user_password)) {
                                if ($user->role_id == 1) {
                                    $_SESSION['user_login'] = serialize($user);
                                    if ($rememberMe) {
                                        setcookie('user_login', serialize($user), time() + 86400, "/");
                                    }
                                    echo "<script>alert('Login berhasil, welcome back again admin!'); window.location.href='./views/user/user_list.php';</script>";
                                } elseif ($user->role_id == 2) {
                                    $_SESSION['anggota_login'] = serialize($user);
                                    if ($rememberMe) {
                                        setcookie('anggota_login', serialize($user), time() + 86400, "/");
                                    }
                                    echo "<script>alert('Login berhasil, welcome back again customer!'); window.location.href='./views/index.php';</script>";
                                }
                                return;
                            }
                        }
        
                        // Jika tidak ditemukan user yang cocok
                        echo "<script>alert('Login gagal'); window.location.href='views/loginPage.php';</script>";
                        break;
        
                    case 'registrasi':
                        $username = $_POST["username_registrasi"];
                        $password = $_POST["password_registrasi"];
                        $no_telp = $_POST["no_telp"];
                        $role_id = 2;
                        $modelUser->addUser($username, $password, $role_id, $no_telp);
                        echo "<script>alert('Registrasi berhasil'); window.location.href='./views/loginPage.php';</script>";
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
                        echo "<script>alert('Logout berhasil!'); window.location.href='./views/loginPage.php';</script>";
                        break;
        
                    case 'customer':
                        // Hapus sesi anggota_login
                        if (isset($_SESSION['anggota_login'])) {
                            unset($_SESSION['anggota_login']);
                        }
                        // Hapus cookie jika ada
                        if (isset($_COOKIE['anggota_login'])) {
                            setcookie('anggota_login', '', time() - 3600, "/");
                        }
                        echo "<script>alert('Logout berhasil!'); window.location.href='./views/index.php';</script>";
                        break;
        
                    default:
                        echo "<script>alert('Logout gagal! Fitur tak dikenal'); window.history.back();</script>";
                        break;
                }
                break;
        default:
            echo "<script>alert('Module tidak dikenal.'); window.history.back();</script>";
            break;
    }
}


?>