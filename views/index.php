<?php
require_once __DIR__ . '../../init.php';
$bukus = $modelBuku->getAllBukuFromDB();

?>

<!DOCTYPE html>
<html lang="en" data-theme="light">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Perpustakaan</title>
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

<body class="bg-modern-accent text-modern-secondary">
    <div class="drawer">
        <input id="my-drawer-3" type="checkbox" class="drawer-toggle" />
        <div class="drawer-content flex flex-col">
            <!-- Navbar -->
            <div class="w-full navbar bg-modern-primary text-modern-accent shadow-lg">
                <div class="flex-none lg:hidden">
                    <label for="my-drawer-3" class="btn btn-square btn-ghost">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            class="inline-block w-6 h-6 stroke-current">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16"></path>
                        </svg>
                    </label>
                </div>
                <div class="flex-1">
                    <a href="./index.php" class="btn btn-ghost normal-case text-xl">
                        <i class="fas fa-book-reader mr-2"></i> Perpustakaan
                    </a>
                </div>
                <div class="flex-1 hidden lg:block">
                    <div class="form-control w-full max-w-xs mx-auto">
                        <input type="text" placeholder="Search"
                            class="input input-bordered w-full bg-modern-accent text-modern-secondary" />
                    </div>
                </div>
                <div class="flex-none hidden lg:block">
                    <ul class="menu menu-horizontal items-center">
                        <li>
                            <?php if (isset($_SESSION['anggota_login'])) { ?>
                            <!-- Jika sudah login, tampilkan form untuk logout -->
                            <form action="../response_input.php?modul=logout&fitur=customer" method="POST">
                                <button type="submit" class="btn">
                                    <i class="fas fa-sign-out-alt"></i> Logout
                                </button>
                            </form>
                            <?php } else { ?>
                            <!-- Jika belum login, tampilkan link untuk login -->
                            <a href="./loginPage.php">
                                <i class="fas fa-sign-in-alt"></i> Login
                            </a>
                            <?php } ?>

                        </li>
                        <li>
                            <a href="./history.php"><i class="fas fa-history"></i></a>
                        </li>
                        <li>
                            <label for="cart-drawer" class="drawer-button btn btn-ghost btn-circle">
                                <div class="indicator">
                                    <i class="fas fa-shopping-cart"></i>
                                    <span class="badge badge-sm indicator-item">2</span>
                                </div>
                            </label>
                        </li>
                        <li>
                            <?php if (isset($_SESSION['anggota_login'])) { ?>
                            <div class="avatar">
                                <a href="./profile.php">
                                    <div class="w-10 h-10 rounded-full overflow-hidden border-2 border-white">
                                        <img src="https://i.pravatar.cc/150?img=3" alt="User Avatar"
                                            class="w-full h-full object-cover" />
                                    </div>
                                </a>
                            </div>
                            <?php } ?>
                        </li>
                    </ul>
                </div>
            </div>
            <!-- Page content here -->
            <div class="p-4">
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 mt-4">
                    <!-- Book cards -->
                    <?php foreach($bukus as $buku) { ?>
                    <div
                        class="card w-full bg-base-100 shadow-xl hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2">
                        <figure class="px-4 pt-4">
                            <img src="https://picsum.photos/seed/1/300/200" alt="Book 1"
                                class="h-48 w-full object-cover rounded-xl" />
                        </figure>
                        <div class="card-body p-4">
                            <h2 class="card-title text-lg"><?= $buku->judul ?></h2>
                            <p class="text-sm"><?= $buku->pengarang ?></p>
                            <p class="text-sm"><?= $buku->penerbit ?></p>
                            <p class="text-sm">Year: <?= $buku->tahunTerbit ?></p>
                            <div class="card-actions justify-end mt-2">
                                <button class="btn btn-sm btn-primary"
                                    onclick="openBorrowModal('Book Title 1', 'https://picsum.photos/seed/1/300/200', '2023')">
                                    <i class="fas fa-book-reader mr-2"></i>Borrow
                                </button>
                                <a href="./book_detail.php" class="btn btn-sm btn-secondary">
                                    <i class="fas fa-info-circle mr-2"></i>Details
                                </a>
                            </div>
                        </div>
                    </div>
                    <?php } ?>
                </div>
            </div>
        </div>
        <div class="drawer-side">
            <label for="my-drawer-3" class="drawer-overlay"></label>
            <ul class="menu p-4 w-80 h-full bg-modern-primary text-modern-accent">
                <li>
                    <a href="./index.php"><i class="fas fa-home mr-2"></i>Home</a>
                </li>
                <li>
                    <a href="./history.php"><i class="fas fa-history mr-2"></i>History</a>
                </li>
                <li>
                    <a href="./profile.php"><i class="fas fa-user mr-2"></i>Profile</a>
                </li>
                <li>
                    <label for="cart-drawer" class="drawer-button">
                        <i class="fas fa-shopping-cart mr-2"></i>Cart
                        <span class="badge badge-sm">2</span>
                    </label>
                </li>
            </ul>
        </div>
    </div>

    <!-- Borrow Modal -->
    <input type="checkbox" id="borrow-modal" class="modal-toggle" />
    <div class="modal">
        <div class="modal-box">
            <h3 class="font-bold text-lg" id="modal-book-title"></h3>
            <img id="modal-book-image" src="" alt="Book Cover" class="w-full h-48 object-cover rounded-lg my-4" />
            <p id="modal-book-year" class="mb-4"></p>
            <div class="form-control">
                <label class="label">
                    <span class="label-text">Number of books to borrow:</span>
                </label>
                <input type="number" id="borrow-quantity" placeholder="Enter quantity" class="input input-bordered"
                    min="1" max="5" />
            </div>
            <div class="modal-action">
                <button class="btn btn-primary" onclick="borrowBook()">Borrow</button>
                <label for="borrow-modal" class="btn">Close</label>
            </div>
        </div>
    </div>

    <!-- Cart Drawer -->
    <div class="drawer drawer-end">
        <input id="cart-drawer" type="checkbox" class="drawer-toggle" />
        <div class="drawer-side fixed top-16 right-0 z-50">
            <label for="cart-drawer" class="drawer-overlay"></label>
            <ul class="menu p-4 w-80 h-[calc(100%-4rem)] bg-modern-accent text-modern-secondary overflow-y-auto">
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-xl font-bold">Your Cart</h2>
                    <label for="cart-drawer" class="btn btn-sm btn-circle btn-ghost">
                        <i class="fas fa-times"></i>
                    </label>
                </div>
                <!-- Cart items -->
                <li class="mb-4">
                    <div class="flex items-center">
                        <img src="https://picsum.photos/seed/1/100/100" alt="Book 1"
                            class="w-16 h-16 object-cover mr-4 rounded" />
                        <div>
                            <h3 class="font-bold">Book Title 1</h3>
                            <p>Quantity: 1</p>
                            <p>Publisher: Publisher A</p>
                        </div>
                    </div>
                    <button class="btn btn-error btn-sm mt-2">
                        <i class="fas fa-trash-alt mr-2"></i>Remove
                    </button>
                </li>
                <li class="mb-4">
                    <div class="flex items-center">
                        <img src="https://picsum.photos/seed/2/100/100" alt="Book 2"
                            class="w-16 h-16 object-cover mr-4 rounded" />
                        <div>
                            <h3 class="font-bold">Book Title 2</h3>
                            <p>Quantity: 1</p>
                            <p>Publisher: Publisher B</p>
                        </div>
                    </div>
                    <button class="btn btn-error btn-sm mt-2">
                        <i class="fas fa-trash-alt mr-2"></i>Remove
                    </button>
                </li>
                <li>
                    <button class="btn btn-primary w-full" onclick="checkoutCart()">
                        <i class="fas fa-check mr-2"></i>Checkout Cart
                    </button>
                </li>
            </ul>
        </div>
    </div>



    <script>
    function checkoutCart() {
        console.log("Cart checked out");
        window.location.href = "./history.php";
    }

    function openBorrowModal(title, imageUrl, year) {
        document.getElementById("modal-book-title").textContent = title;
        document.getElementById("modal-book-image").src = imageUrl;
        document.getElementById(
            "modal-book-year"
        ).textContent = `Year: ${year}`;
        document.getElementById("borrow-modal").checked = true;
    }

    function borrowBook() {
        const title = document.getElementById("modal-book-title").textContent;
        const quantity = document.getElementById("borrow-quantity").value;
        console.log(`Borrowing ${quantity} copies of "${title}"`);
        // Here you would typically send this data to your backend
        document.getElementById("borrow-modal").checked = false;
    }
    </script>
</body>

</html>