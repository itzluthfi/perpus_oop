<?php
require_once __DIR__ . '../../models/modelCart.php';

class ControllerCart {
    private $modelCart;

    public function __construct() {
        // Inisialisasi modelCart untuk mengelola data keranjang
        $this->modelCart = new modelCart();
    }

    public function handleAction($action) {
        // Pesan default untuk respon
        $message = '';

        // Switch berdasarkan aksi yang diberikan
        switch ($action) {
            case 'add':
                // Pastikan semua field yang diperlukan tersedia
                if (isset($_POST['buku_id'], $_POST['user_id'], $_POST['jumlah'])) {
                    $bukuId = $_POST['buku_id'];
                    $userId = $_POST['user_id'];
                    $jumlah = $_POST['jumlah'];

                    // Tambahkan item ke keranjang menggunakan model
                    if ($this->modelCart->addOrUpdateCart($bukuId, $userId, $jumlah)) {
                        $message = "Item berhasil ditambahkan ke keranjang!";
                    } else {
                        $message = "Gagal menambahkan item ke keranjang.";
                    }
                } else {
                    $message = "Semua field wajib diisi.";
                }
                break;

            case 'update':
                // Pastikan semua field yang diperlukan tersedia
                if (isset($_POST['cart_id'], $_POST['jumlah'])) {
                    $cartId = $_POST['cart_id'];
                    $jumlah = $_POST['jumlah'];

                    // Update jumlah item dalam keranjang
                    if ($this->modelCart->updateCart($cartId, $jumlah)) {
                        $message = "Keranjang berhasil diperbarui!";
                    } else {
                        $message = "Gagal memperbarui keranjang.";
                    }
                } else {
                    $message = "Semua field wajib diisi.";
                }
                break;

            case 'delete':
                // Pastikan ID keranjang tersedia untuk dihapus
                if (isset($_GET['id'])) {
                    $cartId = $_GET['id'];

                    // Hapus item dari keranjang
                    if ($this->modelCart->deleteCart($cartId)) {
                        $message = "Item berhasil dihapus dari keranjang!";
                    } else {
                        $message = "Gagal menghapus item dari keranjang.";
                    }
                } else {
                    $message = "ID keranjang tidak tersedia.";
                }
                break;

            case 'clear':
                // Pastikan user_id tersedia untuk membersihkan keranjang
                if (isset($_GET['user_id'])) {
                    $userId = $_GET['user_id'];

                    // Bersihkan keranjang berdasarkan user_id
                    if ($this->modelCart->clearCartByUserId($userId)) {
                        $message = "Keranjang berhasil dikosongkan!";
                    } else {
                        $message = "Gagal mengosongkan keranjang.";
                    }
                } else {
                    $message = "ID pengguna tidak tersedia.";
                }
                break;

            default:
                // Handle aksi yang tidak dikenali
                $message = "Aksi tidak dikenali.";
                break;
        }

        // Tampilkan pesan dan redirect ke halaman daftar keranjang
        echo "<script>alert('$message'); window.location.href='./views/';</script>";
    }
}