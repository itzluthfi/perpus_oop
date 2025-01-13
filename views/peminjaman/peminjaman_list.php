<?php

require_once __DIR__ . '../../../init.php';
// require_once __DIR__ . '../../../auth_check.php';
$peminjamans = $modelPeminjaman->getAllPeminjaman();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Peminjaman</title>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@latest/dist/full.css" rel="stylesheet" type="text/css" />
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <style>
    .modal {
        background-color: rgba(0, 0, 0, 0.5);
        z-index: 50;
    }

    .hidden {
        display: none;
    }
    </style>

    <script>
    function openModal(id) {
        const modal = document.getElementById(id);
        if (modal) {
            modal.classList.remove('hidden');
        } else {
            console.error(`Modal with ID "${id}" not found.`);
        }
    }

    function closeModal(id) {
        const modal = document.getElementById(id);
        if (modal) {
            modal.classList.add('hidden');
        } else {
            console.error(`Modal with ID "${id}" not found.`);
        }
    }

    function confirmDelete(peminjamanId) {
        if (confirm('Apakah Anda yakin ingin menghapus peminjaman ini?')) {
            window.location.href = "/library/response_input.php?modul=peminjaman&fitur=delete&id=" + peminjamanId;
        } else {
            alert("Gagal menghapus data peminjaman.");
            return false;
        }
    }
    </script>
</head>

<body class="bg-gray-100 font-sans leading-normal tracking-normal overflow-hidden">

    <?php include '../includes/navbar.php'; ?>

    <div class="flex">
        <?php include '../includes/sidebar.php'; ?>
        <!-- main content -->
        <div class="flex-1 p-8">
            <div class="container mx-auto overflow-y-auto h-[calc(100vh-4rem)]">
                <div class="bg-base-100 shadow-xl rounded-box p-6">
                    <h1 class="text-4xl font-bold mb-6 text-primary">Manage Peminjaman</h1>

                    <div class="flex justify-between items-center mb-6">
                        <div class="form-control">
                            <input id="search-input" type="text" name="query" placeholder="Search By Name Or ID"
                                class="input input-bordered w-full max-w-xs" />
                        </div>

                        <button class="btn btn-primary">
                            <i class="fa-solid fa-plus mr-2"></i>
                            <a href=".././views/peminjaman/peminjaman_input.php">Add New Peminjaman</a>
                        </button>
                    </div>

                    <!-- Peminjaman Table -->
                    <div class="overflow-x-auto">
                        <table class="table w-full">
                            <thead>
                                <tr>
                                    <th>ID Peminjaman</th>
                                    <th>User</th>
                                    <th>Status</th>
                                    <th>Tanggal Pinjam</th>
                                    <th>Tanggal Kembali</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($peminjamans)) {
                                    foreach ($peminjamans as $peminjaman) {
                                        $status = $modelStatus->getStatusById($peminjaman->status_id);
                                    ?>
                                <tr>
                                    <td class="text-primary font-medium">
                                        <?php echo htmlspecialchars($peminjaman->id); ?>
                                    </td>
                                    <td>
                                        <?php 
                                            $user = $modelUser->getUserById($peminjaman->user_id);
                                            echo htmlspecialchars($user->user_username);
                                            ?>
                                    </td>
                                    <td>
                                        <span class="badge badge-<?= $status->status_color ?>">
                                            <?php echo htmlspecialchars($status->status_nama); ?>
                                        </span>
                                        <button class="btn btn-sm btn-warning ml-2"
                                            onclick="openModal('modal-update-<?= $peminjaman->id ?>')">
                                            <i class="fa-regular fa-pen-to-square"></i>
                                        </button>
                                    </td>
                                    <td>
                                        <?php echo htmlspecialchars($peminjaman->tanggal_pinjam); ?>
                                    </td>
                                    <td>
                                        <?php echo htmlspecialchars($peminjaman->tanggal_kembali); ?>
                                    </td>
                                    <td>
                                        <div class="btn-group">
                                            <button class="btn btn-sm btn-secondary"
                                                onclick="openModal('modal-details-<?= $peminjaman->id ?>')">
                                                <i class="fas fa-info-circle mr-2"></i>Details
                                            </button>
                                            <!-- <button class="btn btn-sm btn-error hover:bg-red-600"
                                                onclick="return confirmDelete(<?= $peminjaman->id ?>)">
                                                <i class="fa-solid fa-trash"></i>
                                            </button> -->
                                        </div>
                                    </td>
                                </tr>
                                <?php } } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <?php if (!empty($peminjamans)) {
    foreach ($peminjamans as $peminjaman) { ?>
    <div id="modal-details-<?= $peminjaman->id ?>"
        class="fixed inset-0 bg-gray-700 bg-opacity-75 overflow-y-auto h-full w-full hidden">
        <div
            class="relative top-20 mx-auto p-6 border w-11/12 md:w-3/4 lg:w-1/2 xl:w-1/3 shadow-lg rounded-lg bg-base-100">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-3xl font-bold text-primary">Detail Peminjaman
                    #<?php echo htmlspecialchars($peminjaman->id); ?></h3>
                <button class="text-gray-500 hover:text-gray-700"
                    onclick="closeModal('modal-details-<?= $peminjaman->id ?>')">
                    <i class="fas fa-times text-2xl"></i>
                </button>
            </div>
            <div class="space-y-4">
                <div class="flex justify-between">
                    <div class="font-semibold text-gray-800">User</div>
                    <div><?php 
                        $user = $modelUser->getUserById($peminjaman->user_id);
                        echo htmlspecialchars($user->user_username);
                    ?></div>
                </div>

                <div class="flex justify-between">
                    <div class="font-semibold text-gray-800">Tanggal Pinjam</div>
                    <div><?php echo htmlspecialchars($peminjaman->tanggal_pinjam); ?></div>
                </div>

                <div class="flex justify-between">
                    <div class="font-semibold text-gray-800">Tanggal Kembali</div>
                    <div><?php echo htmlspecialchars($peminjaman->tanggal_kembali); ?></div>
                </div>

                <div class="mt-6">
                    <h4 class="text-lg font-semibold text-gray-900">Detail Buku</h4>
                    <table class="table w-full">
                        <thead class="bg-primary text-white">
                            <tr>
                                <th class="py-3 px-4 text-left">ID</th>
                                <th class="py-3 px-4 text-left">Judul</th>
                                <th class="py-3 px-4 text-right">Jumlah</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-800">
                            <?php foreach ($peminjaman->detailPeminjaman as $detail) { 
                                $buku = $modelBuku->getBukuById($detail->buku_id);
                            ?>
                            <tr class="hover:bg-gray-100">
                                <td class="py-2 px-4 font-medium text-primary">
                                    <?php echo htmlspecialchars($buku->id); ?></td>
                                <td class="py-2 px-4"><?php echo htmlspecialchars($buku->judul); ?></td>
                                <td class="py-2 px-4 text-right"><?php echo htmlspecialchars($detail->jumlah); ?></td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="mt-6 text-center">
                <button class="btn btn-error"
                    onclick="closeModal('modal-details-<?= $peminjaman->id ?>')">Close</button>
            </div>
        </div>
    </div>
    <?php } } ?>

</body>

</html>