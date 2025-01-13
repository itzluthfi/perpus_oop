<?php
require_once __DIR__ . '../../init.php';

// Ambil data user dari session
$user = unserialize($_SESSION['anggota_login']); // Pastikan $user adalah instance dari NodeUser
?>

<!DOCTYPE html>
<html lang="en" data-theme="light">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Profile - Perpustakaan</title>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@latest/dist/full.css" rel="stylesheet" type="text/css" />
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
    <script>
    tailwind.config = {
        theme: {
            extend: {
                colors: {
                    "modern-primary": "#2A4365",
                    "modern-secondary": "#4A5568",
                    "modern-accent": "#EDF2F7",
                },
            },
        },
    };
    </script>
</head>

<body class="bg-modern-accent min-h-screen flex flex-col">
    <!-- Navbar -->
    <div class="navbar bg-white shadow-lg sticky top-0 z-50">
        <div class="flex-1">
            <a href="./index.php" class="btn btn-ghost normal-case text-xl text-modern-primary font-bold">
                <i class="fas fa-book-reader mr-2"></i> Perpustakaan
            </a>
        </div>
        <div class="flex-none">
            <a href="./index.php" class="btn btn-ghost text-modern-secondary hover:text-modern-primary">
                <i class="fas fa-arrow-left mr-2"></i> Back
            </a>
        </div>
    </div>

    <!-- Profile Card -->
    <div class="flex-grow container mx-auto p-6">
        <div class="card bg-white shadow-2xl rounded-lg overflow-hidden transition-all duration-300 hover:shadow-3xl">
            <div class="bg-gradient-to-r from-modern-primary to-modern-secondary text-white p-10 text-center">
                <div class="avatar mb-6">
                    <div
                        class="w-40 h-40 rounded-full ring ring-modern-accent ring-offset-base-100 ring-offset-4 mx-auto overflow-hidden">
                        <img src="https://api.dicebear.com/6.x/initials/svg?seed=<?= htmlspecialchars($user->user_username) ?>"
                            class="w-full h-full object-cover" />
                    </div>
                </div>
                <h2 class="text-4xl font-bold mb-2"><?= htmlspecialchars($user->user_username) ?></h2>
                <p class="text-xl text-modern-accent">Anggota Perpustakaan</p>
            </div>
            <div class="card-body p-8">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-y-6 text-left">
                    <div class="flex items-center space-x-4">
                        <i class="fas fa-user-circle text-2xl text-modern-primary"></i>
                        <div>
                            <p class="text-sm text-modern-secondary">Username</p>
                            <p class="font-semibold text-modern-primary"><?= htmlspecialchars($user->user_username) ?>
                            </p>
                        </div>
                    </div>
                    <div class="flex items-center space-x-4">
                        <i class="fas fa-envelope text-2xl text-modern-primary"></i>
                        <div>
                            <p class="text-sm text-modern-secondary">Email</p>
                            <p class="font-semibold text-modern-primary">
                                <?= htmlspecialchars($user->user_username) ?>@example.com</p>
                        </div>
                    </div>
                    <div class="flex items-center space-x-4">
                        <i class="fas fa-key text-2xl text-modern-primary"></i>
                        <div>
                            <p class="text-sm text-modern-secondary">Password</p>
                            <div class="flex items-center">
                                <span id="password-field" class="font-semibold text-modern-primary">********</span>
                                <button onclick="togglePassword()"
                                    class="btn btn-ghost btn-sm text-modern-secondary hover:text-modern-primary ml-2"
                                    id="toggle-password-btn" title="Tampilkan Password">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="flex items-center space-x-4">
                        <i class="fas fa-phone text-2xl text-modern-primary"></i>
                        <div>
                            <p class="text-sm text-modern-secondary">No. Telepon</p>
                            <p class="font-semibold text-modern-primary"><?= htmlspecialchars($user->no_telp) ?></p>
                        </div>
                    </div>
                </div>

                <div class="card-actions justify-center mt-8">
                    <button class="btn btn-primary btn-wide bg-modern-primary hover:bg-modern-secondary border-none">
                        <i class="fas fa-edit mr-2"></i> Edit Profil
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="footer bg-modern-primary text-white items-center justify-center">
        <div class="container mx-auto py-6 text-center">
            <p>&copy; 2023 Perpustakaan. All rights reserved.</p>
        </div>
    </footer>

    <script>
    function togglePassword() {
        const passwordField = document.getElementById('password-field');
        const toggleBtn = document.getElementById('toggle-password-btn');
        const isHidden = passwordField.innerText.includes('*');

        if (isHidden) {
            passwordField.innerText = '<?= $user->user_password ?>';
            toggleBtn.innerHTML = '<i class="fas fa-eye-slash"></i>';
            toggleBtn.title = 'Sembunyikan Password';
        } else {
            passwordField.innerText = '********';
            toggleBtn.innerHTML = '<i class="fas fa-eye"></i>';
            toggleBtn.title = 'Tampilkan Password';
        }
    }
    </script>
</body>

</html>