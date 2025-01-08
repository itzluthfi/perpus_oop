<?php
include_once "/laragon/www/laundry_shoes/init.php";

$user_name = unserialize($_SESSION['user_login'])->user_username;

$user_role = $modelRole->getRoleById(unserialize($_SESSION['user_login'])->id_role);
?>

<nav class="bg-yellow-500 p-4 shadow-lg rounded">
    <div class="container mx-auto flex justify-between items-center">
        <div class="ml-1 text-white font-bold text-2xl italic">
            laundry_shoes
        </div>
        <div class="relative flex items-center text-white mr-3">

            <!-- Tempat untuk foto berbentuk lingkaran -->
            <div class=" group">

                <img src="../../public/img/gita.jpg" alt="Profile Image"
                    class="w-11 h-11 rounded-full mr-4 object-cover border-2 border-gray-400">

                <!-- Teks Username dan Role, hidden secara default dan muncul saat hover, diatur agar center -->
                <div
                    class="absolute right-28 top-12 bg-gray-100 text-white p-4 rounded hidden group-hover:flex flex-col items-center justify-center border-2 border-gray-400 transition-all duration-300 ease-in-out">
                    <!-- Foto Profil yang muncul saat hover -->
                    <img src="../../public/img/gita.jpg" alt="Profile Image"
                        class="w-10 h-10 rounded-full my-1 object-cover border-2 border-gray-300">
                    <!-- Username dan Role -->
                    <span class="text-black text-center">
                        <?= $user_name ?></span>
                    <span class="text-slate-500 text-center italic"><?= $user_role->role_nama ?></span>
                </div>
            </div>

            <form action="../../response_input.php?modul=logout&fitur=user" method="POST">
                <button type="submit"
                    class="ml-4 bg-gray-800 hover:bg-red-700 hover:text-black text-white font-bold py-2 px-4 rounded-xl flex border-2 border-gray-900 ">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M8.25 9V5.25A2.25 2.25 0 0 1 10.5 3h6a2.25 2.25 0 0 1 2.25 2.25v13.5A2.25 2.25 0 0 1 16.5 21h-6a2.25 2.25 0 0 1-2.25-2.25V15m-3 0-3-3m0 0 3-3m-3 3H15" />
                    </svg>
                    Logout
                </button>
            </form>

        </div>
    </div>
</nav>