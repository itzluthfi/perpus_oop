<?php
// include_once "/laragon/www/perpus_oop/init.php";
require_once __DIR__ . '../../../init.php';


$user_name = unserialize($_SESSION['user_login'])->user_username;

$user_role = $modelRole->getRoleById(unserialize($_SESSION['user_login'])->role_id);
?>
<nav class="bg-gradient-to-r from-modern-primary via-modern-secondary to-modern-primary p-4 shadow-lg rounded-lg">
    <div class="container mx-auto flex justify-between items-center">
        <div class="flex-1">
            <a href="./index.php" class="btn btn-ghost normal-case text-xl">
                <i class="fas fa-book-reader mr-2"></i> Perpustakaan
            </a>
        </div>
        <div class="relative flex items-center text-modern-accent mr-3">
            <!-- Foto Profil -->
            <div class="group">
                <img src="../img/wp2.jpg" alt="Profile Image"
                    class="w-11 h-11 rounded-full mr-4 object-cover border-4 border-modern-accent shadow-lg">
                <!-- Username dan Role -->
                <div
                    class="absolute right-20 top-14 bg-modern-secondary text-modern-accent p-4 rounded-md hidden group-hover:flex flex-col items-center justify-center border border-modern-accent shadow-lg transition-all duration-300 ease-in-out">
                    <img src="../../public/img/gita.jpg" alt="Profile Image"
                        class="w-12 h-12 rounded-full mb-2 object-cover border-2 border-modern-accent">
                    <span class="text-lg font-semibold"><?= $user_name ?></span>
                    <span class="text-sm italic text-gray-400"><?= $user_role->role_nama ?></span>
                </div>
            </div>

            <!-- Tombol Logout -->
            <form action="../../response_input.php?modul=logout&fitur=user" method="POST">
                <button type="submit"
                    class="ml-4 bg-modern-accent hover:bg-red-700 text-modern-primary hover:text-modern-accent font-bold py-2 px-5 rounded-lg flex items-center border border-modern-accent shadow-md transition-all duration-300">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-6 h-6 mr-2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M8.25 9V5.25A2.25 2.25 0 0 1 10.5 3h6a2.25 2.25 0 0 1 2.25 2.25v13.5A2.25 2.25 0 0 1 16.5 21h-6a2.25 2.25 0 0 1-2.25-2.25V15m-3 0-3-3m0 0 3-3m-3 3H15" />
                    </svg>
                    Logout
                </button>
            </form>
        </div>
    </div>
</nav>