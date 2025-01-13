<?php
require_once __DIR__ . '../../../init.php';

$user_name = unserialize($_SESSION['user_login'])->user_username;
$user_role = $modelRole->getRoleById(unserialize($_SESSION['user_login'])->role_id);
?>

<div class="relative flex h-[calc(100vh-2rem)] ">
    <!-- Sidebar -->
    <div id="sidebar"
        class=" relative flex flex-col w-64 bg-[#4A5568] text-white p-4 shadow-2xl rounded-xl transition-transform duration-300 transform">
        <!-- Sidebar Header -->
        <div class="flex items-center justify-between mb-6">
            <h5 class="text-xl font-semibold italic tracking-wide text-gray-800">WELCOME BACK</h5>
            <button id="closeSidebar" class="text-white hover:text-gray-400">
                <i class="fa-solid fa-times"></i>
            </button>
        </div>

        <!-- User Info -->
        <div class="flex items-center justify-left mb-6">
            <img src="../img/wp3.jpg" alt="User"
                class="w-14 h-14 mb-4 rounded-full object-cover border-2 border-gray-500">
            <div class="p-4 mb-4 ml-4">
                <h6 class="font-bold text-gray-800"> <?= $user_name ?> </h6>
                <span class="italic text-sm text-gray-400"> <?= $user_role->role_nama ?> </span>
            </div>
        </div>

        <!-- Navigation Links -->
        <nav class="flex flex-col gap-2">
            <a href="../../views/dashboard/dashboard.php" class="nav-link">
                <i class="fa-solid fa-house"></i>
                <span>Dashboard</span>
            </a>
            <a href="../../views/role/role_list.php" class="nav-link">
                <i class="fa-solid fa-circle-user"></i>
                <span>Master Data Role</span>
            </a>
            <a href="../../views/status/status_list.php" class="nav-link">
                <i class="fa-solid fa-bell"></i>
                <span>Master Data Status</span>
            </a>
            <a href="../../views/user/user_list.php" class="nav-link">
                <i class="fa-solid fa-users"></i>
                <span>Master Data User</span>
            </a>
            <a href="../../views/buku/buku_list.php" class="nav-link">
                <i class="fa-solid fa-handshake"></i>
                <span>Master Data Buku</span>
            </a>

            <div class="relative group">
                <button class="nav-link">
                    <i class="fa-solid fa-cart-shopping"></i>
                    <span>Manage Peminjaman</span>
                    <i class="fa-solid fa-chevron-down ml-auto"></i>
                </button>
                <div class="hidden pl-6 group-hover:block">
                    <a href="../../views/peminjaman/peminjaman_input.php" class="sub-nav-link">
                        <i class="fa-solid fa-clipboard"></i>
                        <span>Add Peminjaman</span>
                    </a>
                    <a href="../../views/peminjaman/peminjaman_list.php" class="sub-nav-link">
                        <i class="fa-solid fa-clipboard"></i>
                        <span>List Peminjaman</span>
                    </a>
                </div>
            </div>
        </nav>
    </div>

    <!-- Main Content -->
    <div class="flex-1 p-4">
        <button id="openSidebar" class="p-2 bg-gray-200 text-white rounded-lg shadow-lg hover:bg-gray-600">
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
    gap: 0.75rem;
    padding: 0.85rem;
    border-radius: 0.5rem;
    background: #A0AEC0;
    color: rgb(7, 30, 61);
    text-decoration: none;
    transition: transform 0.2s, background 0.3s, box-shadow 0.3s;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

.nav-link:hover {
    background: #2D3748;
    transform: scale(1.05);
    box-shadow: 0 6px 8px rgba(0, 0, 0, 0.2);
}

.sub-nav-link {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    padding: 0.65rem;
    border-radius: 0.375rem;
    background: #A0AEC0;
    color: rgb(7, 30, 61);
    text-decoration: none;
    transition: transform 0.2s, background 0.3s, box-shadow 0.3s;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

.sub-nav-link:hover {
    background: #2D3748;
    color: #E2E8F0;
    transform: scale(1.05);
    box-shadow: 0 6px 8px rgba(0, 0, 0, 0.2);
}
</style>