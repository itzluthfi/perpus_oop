<?php
require_once "/laragon/www/perpustakaan/model/modelBuku.php";

class ControllerBuku {
    private $modelBuku;

    public function __construct() {
        // Inisialisasi modelBuku untuk mengelola data buku
        $this->modelBuku = new modelBuku();
    }

    public function handleAction($action) {
        // Pesan default untuk respon
        $message = '';

        // Switch berdasarkan aksi yang diberikan
        switch ($action) {
            case 'add':
                // Pastikan semua field yang diperlukan tersedia
                if (isset($_POST['judul'], $_POST['pengarang'], $_POST['penerbit'], $_POST['tahun_terbit'], $_POST['stok'])) {
                    $judul = $_POST['judul'];
                    $pengarang = $_POST['pengarang'];
                    $penerbit = $_POST['penerbit'];
                    $tahunTerbit = $_POST['tahun_terbit'];
                    $stok = $_POST['stok'];

                    // Tambahkan buku baru menggunakan model
                    if ($this->modelBuku->addBuku($judul, $pengarang, $penerbit, $tahunTerbit, $stok)) {
                        $message = "Buku berhasil ditambahkan!";
                    } else {
                        $message = "Gagal menambahkan buku.";
                    }
                } else {
                    $message = "Semua field wajib diisi.";
                }
                break;

            case 'update':
                // Pastikan semua field yang diperlukan tersedia
                if (isset($_POST['id'], $_POST['judul'], $_POST['pengarang'], $_POST['penerbit'], $_POST['tahun_terbit'], $_POST['stok'])) {
                    $id = $_POST['id'];
                    $judul = $_POST['judul'];
                    $pengarang = $_POST['pengarang'];
                    $penerbit = $_POST['penerbit'];
                    $tahunTerbit = $_POST['tahun_terbit'];
                    $stok = $_POST['stok'];

                    // Update buku menggunakan model
                    if ($this->modelBuku->updateBuku($id, $judul, $pengarang, $penerbit, $tahunTerbit, $stok)) {
                        $message = "Buku berhasil diperbarui!";
                    } else {
                        $message = "Gagal memperbarui buku.";
                    }
                } else {
                    $message = "Semua field wajib diisi.";
                }
                break;

            case 'delete':
                // Pastikan ID buku tersedia untuk dihapus
                if (isset($_GET['id'])) {
                    $id = $_GET['id'];

                    // Hapus buku menggunakan model
                    if ($this->modelBuku->deleteBuku($id)) {
                        $message = "Buku berhasil dihapus!";
                    } else {
                        $message = "Gagal menghapus buku.";
                    }
                } else {
                    $message = "ID buku tidak tersedia.";
                }
                break;

            default:
                // Handle aksi yang tidak dikenali
                $message = "Aksi tidak dikenali.";
                break;
        }

        // Tampilkan pesan dan redirect ke halaman daftar buku
        echo "<script>alert('$message'); window.location.href='/perpustakaan/views/buku/buku_list.php';</script>";
    }
}