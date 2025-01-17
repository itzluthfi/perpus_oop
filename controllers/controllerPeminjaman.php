    <?php
    require_once __DIR__ . '../../models/modelPeminjaman.php';
    require_once __DIR__ . '../../models/modelCart.php';


    class ControllerPeminjaman {
        private $modelPeminjaman;
        private $modelCart;

        public function __construct() {
            $this->modelPeminjaman = new ModelPeminjaman();
            $this->modelCart = new ModelCart();
        }

        public function handleAction($action) {
            switch ($action) {
                
                case 'add':
                    // Validasi data POST
                    if (isset($_POST['user_id'], $_POST['tanggal_pinjam'], $_POST['tanggal_kembali'], $_POST['status_id'], $_POST['bukus'])) {
                        $user_id = intval($_POST['user_id']);
                        $tanggal_pinjam = $_POST['tanggal_pinjam'];
                        $tanggal_kembali = $_POST['tanggal_kembali'];
                        $status_id = intval($_POST['status_id']);

                        // Validasi data detailBuku[]
                        $detailBuku = json_decode($_POST['bukus'], true);
                        if (json_last_error() !== JSON_ERROR_NONE || !is_array($detailBuku) || empty($detailBuku)) {
                            echo "<script>alert('Data detail buku tidak valid!'); window.history.back();</script>";
                            break;
                        }

                        foreach ($detailBuku as $buku) {
                            if (!isset($buku['buku_id'], $buku['jumlah']) || intval($buku['jumlah']) <= 0) {
                                echo "<script>alert('Data buku tidak lengkap atau tidak valid!'); window.history.back();</script>";
                                break 2;
                            }
                        }

                        // Tambahkan peminjaman dan detailnya
                        $isSuccess = $this->modelPeminjaman->addPeminjaman($user_id, $tanggal_pinjam, $tanggal_kembali, $status_id, $detailBuku);

                        if ($isSuccess) {
                            if(isset($_SESSION['anggota_login'])) {
                            echo "<script>alert('Peminjaman berhasil ditambahkan!'); window.location.href='./views/';</script>";
                                
                            }
                            echo "<script>alert('Peminjaman berhasil ditambahkan!'); window.location.href='./views/peminjaman/peminjaman_list.php';</script>";
                        } else {
                            echo "<script>alert('Gagal menambahkan peminjaman!'); window.history.back();</script>";
                        }
                    } else {
                        echo "<script>alert('Data yang dikirim tidak lengkap!,{$_POST}'); window.history.back();</script>";
                    }
                    break;

                case 'checkout':
                // Validasi data POST
                if (isset($_POST['user_id'], $_POST['tanggal_pinjam'], $_POST['tanggal_kembali'], $_POST['status_id'], $_POST['bukus'])) {
                    $user_id = intval($_POST['user_id']);
                    $tanggal_pinjam = $_POST['tanggal_pinjam'];
                    $tanggal_kembali = $_POST['tanggal_kembali'];
                    $status_id = intval($_POST['status_id']);

                    // Validasi data detailBuku[]
                    $detailBuku = json_decode($_POST['bukus'], true);
                    if (json_last_error() !== JSON_ERROR_NONE || !is_array($detailBuku) || empty($detailBuku)) {
                        echo "<script>alert('Data detail buku tidak valid!'); window.history.back();</script>";
                        break;
                    }

                    foreach ($detailBuku as $buku) {
                        if (!isset($buku['buku_id'], $buku['jumlah']) || intval($buku['jumlah']) <= 0) {
                            echo "<script>alert('Data buku tidak lengkap atau tidak valid!'); window.history.back();</script>";
                            break 2;
                        }
                    }

                    // Tambahkan peminjaman dan detailnya
                    $isSuccess = $this->modelPeminjaman->addPeminjaman($user_id, $tanggal_pinjam, $tanggal_kembali, $status_id, $detailBuku);

                    if ($isSuccess) {
                        if(isset($_SESSION['anggota_login'])) {
                        echo "<script>alert('Peminjaman berhasil ditambahkan!'); window.location.href='./views/history.php';</script>";
                        $this->modelCart->clearCartByUserId($user_id);
                            
                        }
                        echo "<script>alert('Peminjaman berhasil ditambahkan!'); window.location.href='./views/peminjaman/peminjaman_list.php';</script>";
                    } else {
                        echo "<script>alert('Gagal menambahkan peminjaman!'); window.history.back();</script>";
                    }
                } else {
                    echo "<script>alert('Data yang dikirim tidak lengkap!,{$_POST}'); window.history.back();</script>";
                }
                break;

                case 'delete':
                    // Hapus peminjaman berdasarkan ID
                    if (isset($_GET['id'])) {
                        $peminjamanId = intval($_GET['id']);
                        if ($this->modelPeminjaman->deletePeminjaman($peminjamanId)) {
                            echo "<script>alert('Peminjaman berhasil dihapus!'); window.location.href='./views/peminjaman/peminjaman_list.php';</script>";
                        } else {
                            echo "<script>alert('Gagal menghapus peminjaman!'); window.location.href='./views/peminjaman/peminjaman_list.php';</script>";
                        }
                    } else {
                        echo "<script>alert('ID peminjaman tidak ditemukan!'); window.history.back();</script>";
                    }
                    break;

                case 'updateStatus':
                    // Update status peminjaman berdasarkan ID
                    if (isset($_POST['peminjaman_id'], $_POST['status_id'])) {
                        $peminjamanId = intval($_POST['peminjaman_id']);
                        $statusId = intval($_POST['status_id']);

                        if ($this->modelPeminjaman->updatePeminjamanStatus($peminjamanId, $statusId)) {
                            echo "<script>alert('Status peminjaman berhasil diperbarui!'); window.location.href='./views/peminjaman/peminjaman_list.php';</script>";
                        } else {
                            echo "<script>alert('Gagal memperbarui status peminjaman!'); window.history.back();</script>";
                        }
                    } else {
                        echo "<script>alert('Data yang dikirim tidak lengkap!'); window.history.back();</script>";
                    }
                    break;

                default:
                    echo "<script>alert('Aksi tidak dikenal!'); window.location.href='./views/peminjaman/peminjaman_list.php';</script>";
                    break;
            }
        }
    }

    ?>