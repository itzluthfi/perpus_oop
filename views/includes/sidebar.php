<?php
include_once "/laragon/www/laundry_shoes/init.php";

$user_name = unserialize($_SESSION['user_login'])->user_username;
$user_role = $modelRole->getRoleById(unserialize($_SESSION['user_login'])->id_role);
?>

<div class="relative flex h-[calc(100vh-2rem)]">
    <!-- Sidebar -->
    <div id="sidebar"
        class="relative flex flex-col w-64 bg-gray-900 text-gray-200 p-4 shadow-xl rounded-xl transition-transform duration-300 transform">
        <!-- Sidebar Header -->
        <div class="flex items-center justify-between mb-6">
            <h5 class="text-xl font-semibold italic tracking-wide">WELCOME BACK</h5>
            <button id="closeSidebar" class="text-gray-400 hover:text-white">
                <i class="fa-solid fa-times"></i>
            </button>
        </div>

        <!-- User Info -->
        <div class="flex items-center justify-left mb-6">

            <img src="/laundry_shoes/public/img/gita.jpg" alt="User"
                class="w-14 h-14 mb-4 rounded-full object-cover border-2 border-gray-400">
            <div class="p-4 mb-4 ml-4">
                <h6 class="font-bold text-white"> <?= $user_name ?> </h6>
                <span class="italic text-sm text-gray-400"> <?= $user_role->role_nama ?> </span>
            </div>
        </div>

        <!-- Navigation Links -->
        <nav class="flex flex-col gap-2">
            <a href="/laundry_shoes/views/dashboard/dashboard.php" class="nav-link">
                <i class="fa-solid fa-house"></i>
                <span>Dashboard</span>
            </a>
            <a href="/laundry_shoes/views/role/role_list.php" class="nav-link">
                <i class="fa-solid fa-circle-user"></i>
                <span>Master Data Role</span>
            </a>
            <a href="/laundry_shoes/views/status/status_list.php" class="nav-link">
                <i class="fa-solid fa-bell"></i>
                <span>Master Data Status</span>
            </a>
            <a href="/laundry_shoes/views/user/user_list.php" class="nav-link">
                <i class="fa-solid fa-users"></i>
                <span>Master Data User</span>
            </a>
            <a href="/laundry_shoes/views/layanan/layanan_list.php" class="nav-link">
                <i class="fa-solid fa-handshake"></i>
                <span>Master Data Layanan</span>
            </a>

            <div class="relative group">
                <button class="nav-link">
                    <i class="fa-solid fa-cart-shopping"></i>
                    <span>Manage Reservasi</span>
                    <i class="fa-solid fa-chevron-down ml-auto"></i>
                </button>
                <div class="hidden pl-6 group-hover:block">
                    <a href="/laundry_shoes/views/reservasi/reservasi_input.php" class="sub-nav-link">
                        <i class="fa-solid fa-clipboard"></i>
                        <span>Add Reservasi</span>
                    </a>
                    <a href="/laundry_shoes/views/reservasi/reservasi_list.php" class="sub-nav-link">
                        <i class="fa-solid fa-clipboard"></i>
                        <span>List Reservasi</span>
                    </a>
                </div>
            </div>
        </nav>
    </div>

    <!-- Main Content -->
    <div class="flex-1 p-4">
        <button id="openSidebar" class="p-2 bg-gray-900 text-white rounded-lg shadow-lg hover:bg-gray-800">
            <i class="fa-solid fa-bars"></i>
        </button>
    </div>
</div>

<script>
const sidebar = document.getElementById('sidebar');
const openSidebarBtn = document.getElementById('openSidebar');
const closeSidebarBtn = document.getElementById('closeSidebar');

openSidebarBtn.addEventListener('click', () => {
    sidebar.classList.remove('-translate-x-full');
});

closeSidebarBtn.addEventListener('click', () => {
    sidebar.classList.add('-translate-x-full');
});
</script>

<style>
.nav-link {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    padding: 0.75rem;
    border-radius: 0.5rem;
    background: #2d3748;
    color: #edf2f7;
    text-decoration: none;
    transition: all 0.2s;
}

.nav-link:hover {
    background: #4a5568;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

.sub-nav-link {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    padding: 0.5rem;
    border-radius: 0.375rem;
    background: #2d3748;
    color: #a0aec0;
    text-decoration: none;
    transition: all 0.2s;
}

.sub-nav-link:hover {
    background: #4a5568;
    color: #edf2f7;
}
</style>