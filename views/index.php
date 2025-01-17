<?php
require_once __DIR__ . '../../init.php';
$bukus = $modelBuku->getAllBukuFromDB();

if(isset($_SESSION['anggota_login'])){
    $carts = $modelCart->getCartByUserId(unserialize($_SESSION['anggota_login'])->id); 
    $user = $modelUser->getUserById(unserialize($_SESSION['anggota_login'])->id);
    // var_dump($carts);
}else{
    $carts = [];
}


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
                                    <span class="badge badge-sm indicator-item"><?= count($carts) ?></span>
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
                                <?php if(isset($_SESSION['anggota_login'])) { ?>
                                <button class="btn btn-sm btn-primary" onclick="openBorrowModal(this)"
                                    data-judul="<?= $buku->judul; ?>" data-pengarang="<?= $buku->pengarang; ?>"
                                    data-penerbit="<?= $buku->penerbit; ?>" data-image="img/wp1.jpg"
                                    data-tahunTerbit="<?= $buku->tahunTerbit; ?>" data-buku_id="<?= $buku->id; ?>">

                                    <i class="fas fa-book-reader mr-2"></i>Borrow
                                </button>
                                <?php }else{ ?>
                                <button class="btn btn-sm btn-primary" onclick="alert('silahkan login dahulu kawan')"
                                    data-judul="<?= $buku->judul; ?>" data-pengarang="<?= $buku->pengarang; ?>"
                                    data-penerbit="<?= $buku->penerbit; ?>" data-image="img/wp1.jpg"
                                    data-tahunTerbit="<?= $buku->tahunTerbit; ?>" data-buku_id="<?= $buku->id; ?>">

                                    <i class="fas fa-book-reader mr-2"></i>Borrow
                                </button>
                                <?php } ?>
                                <a href="./book_detail.php?id=<?= $buku->id ?>" class="btn btn-sm btn-secondary">
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
                        <span class="badge badge-sm"><?= count($carts) ?></span>
                    </label>
                </li>
            </ul>
        </div>
    </div>

    <form id="borrow-form" method="POST" action="../response_input.php?modul=cart&fitur=add">
        <input type="checkbox" id="borrow-modal" class="modal-toggle" />
        <div class="modal">
            <div class="modal-box">
                <h3 class="font-bold text-lg" id="modal-book-title"></h3>
                <img id="modal-book-image" src="" alt="Book Cover" class="w-full h-48 object-cover rounded-lg my-4" />
                <p id="modal-book-year" class="mb-4"></p>
                <!-- Hidden inputs for book data -->
                <input type="hidden" name="buku_id" id="hidden-buku_id" />
                <input type="hidden" name="user_id" value="<?= $user->id; ?>" />

                <div class="form-control">
                    <label class="label">
                        <span class="label-text">Number of books to borrow:</span>
                    </label>
                    <input type="number" name="jumlah" id="borrow-quantity" placeholder="Enter quantity"
                        class="input input-bordered" min="1" max="5" required />
                </div>
                <div class="modal-action">
                    <button type="submit" class="btn btn-primary">Borrow</button>
                    <label for="borrow-modal" class="btn">Close</label>
                </div>
            </div>
        </div>
    </form>


    <!-- Cart Drawer -->
    <div class="drawer drawer-end">
        <input id="cart-drawer" type="checkbox" class="drawer-toggle" />
        <div class="drawer-side fixed top-16 right-0 z-50">
            <label for="cart-drawer" class="drawer-overlay"></label>
            <form id="cart-form" action="../response_input.php?modul=peminjaman&fitur=checkout" method="POST"
                class="menu p-4 w-80 h-[calc(100%-4rem)] bg-modern-accent text-modern-secondary overflow-y-auto">
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-xl font-bold">Your Cart</h2>
                    <label for="cart-drawer" class="btn btn-sm btn-circle btn-ghost">
                        <i class="fas fa-times"></i>
                    </label>
                </div>

                <!-- Hidden Inputs -->
                <input type="hidden" name="user_id" value="<?= $user->id ?>" />
                <input type="hidden" name="status_id" value="2" />
                <input type="hidden" id="bukus-input" name="bukus" value="" />

                <!-- Cart Items -->
                <?php foreach ($carts as $cart): 
                $buku = $modelBuku->getBukuById($cart->buku_id);
            ?>
                <li class="mb-4 cart-item" data-buku-id="<?= $cart->buku_id ?>" data-jumlah="<?= $cart->jumlah ?>">
                    <div class="flex items-center">
                        <img src="https://picsum.photos/seed/1/100/100" alt="Book 1"
                            class="w-16 h-16 object-cover mr-4 rounded" />
                        <div>
                            <h3 class="font-bold"><?= $buku->judul ?></h3>
                            <p>Quantity: <?= $cart->jumlah ?></p>
                            <p>Publisher: <?= $buku->penerbit ?></p>

                        </div>

                    </div>
                </li>
                <?php endforeach; ?>

                <!-- Additional Inputs -->
                <div class="form-control mb-4">
                    <label class="label">
                        <span class="label-text">Borrow Date:</span>
                    </label>
                    <input type="date" name="tanggal_pinjam" class="input input-bordered" required />
                </div>
                <div class="form-control mb-4">
                    <label class="label">
                        <span class="label-text">Return Date:</span>
                    </label>
                    <input type="date" name="tanggal_kembali" class="input input-bordered" required />
                </div>

                <!-- Checkout Button -->
                <li>
                    <button type="submit" class="btn btn-primary w-full">
                        <i class="fas fa-check mr-2"></i>Checkout Cart
                    </button>
                </li>
            </form>
        </div>
    </div>


    <script>
    // Handle form submission to generate bukus JSON
    document.getElementById('cart-form').addEventListener('submit', function(event) {
        const cartItems = document.querySelectorAll('.cart-item');
        const bukus = Array.from(cartItems).map(item => ({
            buku_id: parseInt(item.getAttribute('data-buku-id')),
            jumlah: parseInt(item.getAttribute('data-jumlah'))
        }));

        // Set bukus JSON to hidden input
        document.getElementById('bukus-input').value = JSON.stringify(bukus);
    });
    </script>

    <script>
    function openBorrowModal(button) {
        // Ambil data dari atribut tombol
        const buku_id = button.getAttribute('data-buku_id');
        const judul = button.getAttribute('data-judul');
        const pengarang = button.getAttribute('data-pengarang');
        const penerbit = button.getAttribute('data-penerbit');
        const image = button.getAttribute('data-image');
        const tahunTerbit = button.getAttribute('data-tahunTerbit');

        // Isi data ke elemen modal
        document.getElementById('modal-book-title').textContent = `${judul} (${tahunTerbit})`;
        document.getElementById('modal-book-year').textContent = `Written by ${pengarang}, published by ${penerbit}`;
        document.getElementById('modal-book-image').src = image;

        // Isi data ke input hidden di form
        document.getElementById('hidden-buku_id').value = buku_id;


        // Tampilkan modal
        document.getElementById('borrow-modal').checked = true;
    }

    function borrowBook() {
        const quantity = document.getElementById('borrow-quantity').value;
        const title = document.getElementById('modal-book-title').textContent;

        if (quantity > 0) {
            alert(`You have borrowed ${quantity} copies of "${title}".`);
        } else {
            alert("Please enter a valid quantity.");
        }

        // Tutup modal setelah aksi
        document.getElementById('borrow-modal').checked = false;
    }



    function checkoutCart() {
        console.log("Cart checked out");
        window.location.href = "./history.php";
    }
    </script>
</body>

</html>