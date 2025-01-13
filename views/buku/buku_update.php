<?php
    require_once __DIR__ . '../../../init.php';

    $obj_buku = $modelBuku->getBukuById($_GET['id']);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Buku</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>

<body class="bg-gray-100 font-sans leading-normal tracking-normal">

    <!-- Navbar -->
    <?php include '../includes/navbar.php'; ?>

    <!-- Main container -->
    <div class="flex">
        <!-- Sidebar -->
        <?php include '../includes/sidebar.php'; ?>

        <!-- Main Content -->
        <div class="flex-1 p-8">
            <!-- Formulir Update Buku -->
            <div class="max-w-lg mx-auto bg-white p-6 rounded-lg shadow-lg">
                <h2 class="text-2xl font-bold mb-6 text-gray-800">Update Buku</h2>
                <form action="../../response_input.php?modul=buku&fitur=update&id=<?= $obj_buku->id ?>" method="POST">
                    <!-- Judul Buku -->
                    <div class="mb-4">
                        <label for="judul" class="block text-gray-700 text-sm font-bold mb-2">Judul Buku:</label>
                        <input type="text" id="judul" name="judul"
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                            placeholder="Masukkan Judul Buku" value="<?= $obj_buku->judul ?>" required>
                    </div>

                    <!-- Pengarang Buku -->
                    <div class="mb-4">
                        <label for="pengarang" class="block text-gray-700 text-sm font-bold mb-2">Pengarang:</label>
                        <input type="text" id="pengarang" name="pengarang"
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                            placeholder="Masukkan Nama Pengarang" value="<?= $obj_buku->pengarang ?>" required>
                    </div>

                    <!-- Penerbit Buku -->
                    <div class="mb-4">
                        <label for="penerbit" class="block text-gray-700 text-sm font-bold mb-2">Penerbit:</label>
                        <input type="text" id="penerbit" name="penerbit"
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                            placeholder="Masukkan Nama Penerbit" value="<?= $obj_buku->penerbit ?>" required>
                    </div>

                    <!-- Tahun Terbit Buku -->
                    <div class="mb-4">
                        <label for="tahun_terbit" class="block text-gray-700 text-sm font-bold mb-2">Tahun
                            Terbit:</label>
                        <input type="number" id="tahun_terbit" name="tahun_terbit"
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                            placeholder="Masukkan Tahun Terbit" value="<?= $obj_buku->tahunTerbit ?>" required>
                    </div>

                    <!-- Stok Buku -->
                    <div class="mb-4">
                        <label for="stok" class="block text-gray-700 text-sm font-bold mb-2">Stok:</label>
                        <input type="number" id="stok" name="stok"
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                            placeholder="Masukkan Jumlah Stok" value="<?= $obj_buku->stok ?>" required>
                    </div>

                    <!-- Submit and Cancel Buttons -->
                    <div class="flex items-center justify-between">
                        <!-- Tombol Submit -->
                        <button type="submit"
                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                            Submit
                        </button>

                        <!-- Tombol Cancel -->
                        <a href="javascript:history.back()"
                            class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                            Cancel
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>

</body>

</html>