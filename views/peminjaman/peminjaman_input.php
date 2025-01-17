<?php
require_once __DIR__ . '../../../init.php';

$user = unserialize($_SESSION['user_login']);

$bukus = $modelBuku->getAllBukuFromDB();
?>
<!DOCTYPE html>
<html lang="en" data-theme="light">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Peminjaman</title>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@latest/dist/full.css" rel="stylesheet" type="text/css" />
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
    tailwind.config = {
        theme: {
            extend: {
                colors: {
                    primary: "#3b82f6",
                    secondary: "#1d4ed8",
                    accent: "#fbbf24",
                }
            }
        }
    }
    </script>
</head>

<body class="bg-gray-100 font-sans leading-normal tracking-normal overflow-hidden">

    <?php include '../includes/navbar.php'; ?>

    <div class="flex">
        <?php include '../includes/sidebar.php'; ?>

        <!-- Main Content -->
        <div class="flex-1 p-8">
            <div class="container mx-auto overflow-y-auto h-[calc(100vh-4rem)]">
                <h1 class="text-4xl font-bold mb-5 pb-2 text-primary italic">Tambah Peminjaman</h1>

                <form action="../../response_input.php?modul=peminjaman&fitur=add" method="POST" id="peminjamanForm"
                    class="bg-blue-50 p-8 rounded-lg shadow-lg">
                    <h3 class="text-2xl font-semibold mb-4 text-secondary">Detail Peminjaman</h3>

                    <!-- Input Tanggal -->
                    <div class="mb-6">
                        <label for="tanggal_pinjam" class="block text-sm font-medium text-gray-700">Tanggal
                            Pinjam</label>
                        <input type="date" name="tanggal_pinjam" id="tanggal_pinjam" required
                            class="mt-2 p-3 border border-blue-300 rounded-lg w-full bg-white focus:ring focus:ring-blue-200">
                    </div>
                    <div class="mb-6">
                        <label for="tanggal_kembali" class="block text-sm font-medium text-gray-700">Tanggal
                            Kembali</label>
                        <input type="date" name="tanggal_kembali" id="tanggal_kembali" required
                            class="mt-2 p-3 border border-blue-300 rounded-lg w-full bg-white focus:ring focus:ring-blue-200">
                    </div>

                    <!-- Pilihan Buku -->
                    <div class="mb-6 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        <div>
                            <label for="bukuSelect" class="block text-sm font-medium text-gray-700">Pilih Buku</label>
                            <select id="bukuSelect"
                                class="mt-2 p-3 border border-blue-300 rounded-lg w-full bg-blue-50 focus:ring focus:ring-blue-200">
                                <option value="" disabled selected>Pilih Buku</option>
                                <?php foreach ($bukus as $buku): ?>
                                <option value="<?= $buku->id; ?>" data-judul="<?= $buku->judul; ?>">
                                    <?= $buku->id; ?> - <?= $buku->judul; ?>
                                </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div>
                            <label for="jumlahInput" class="block text-sm font-medium text-gray-700">Jumlah</label>
                            <input type="number" id="jumlahInput" min="1"
                                class="mt-2 p-3 border border-blue-300 rounded-lg w-full bg-white focus:ring focus:ring-blue-200">
                        </div>
                        <div class="flex items-end">
                            <button type="button" id="addbukuBtn"
                                class="px-6 py-3 text-base font-semibold tracking-tight text-white bg-secondary rounded-lg hover:bg-blue-700 focus:ring focus:ring-blue-200">
                                Tambah Buku
                            </button>
                        </div>
                    </div>

                    <!-- Table Buku -->
                    <table id="bukuTable" class="w-full bg-white shadow-md rounded-lg overflow-hidden mt-6">
                        <thead class="bg-[#A0AEC0]">
                            <tr>
                                <th class="py-2 px-4 border-b border-blue-200 text-left text-blue-900">ID</th>
                                <th class="py-2 px-4 border-b border-blue-200 text-left text-blue-900">Judul</th>
                                <th class="py-2 px-4 border-b border-blue-200 text-left text-blue-900">Jumlah</th>
                                <th class="py-2 px-4 border-b border-blue-200 text-left text-blue-900">Aksi</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>



                    <!-- Buttons -->
                    <div class="flex items-center gap-4 mt-6">
                        <button type="submit"
                            class="px-6 py-3 text-lg font-semibold text-white bg-primary rounded-lg hover:bg-blue-700 focus:ring focus:ring-blue-200">
                            Simpan Peminjaman
                        </button>
                        <button type="button" id="cancelBtn"
                            class="px-6 py-3 text-lg font-semibold text-white bg-red-500 rounded-lg hover:bg-red-700 focus:ring focus:ring-red-200">
                            Batal
                        </button>
                    </div>

                    <!-- Tambahkan hidden input untuk menyimpan data buku -->
                    <input type="hidden" id="bukus" name="bukus" value="[]">
                    <input type="hidden" name="status_id" id="status_id" value="1">
                    <input type="hidden" name="user_id" id="user_id" value="<?= $user->id?>">
                </form>
            </div>
        </div>
    </div>

    <script>
    // Add buku event
    document.getElementById('addbukuBtn').addEventListener('click', function() {
        const bukuSelect = document.getElementById('bukuSelect');
        const jumlahInput = document.getElementById('jumlahInput');
        const bukuTable = document.getElementById('bukuTable').querySelector('tbody');
        const bukusInput = document.getElementById('bukus');

        const selectedOption = bukuSelect.options[bukuSelect.selectedIndex];
        const bukuId = selectedOption.value;
        const bukuName = selectedOption.getAttribute('data-judul'); // Sesuaikan dengan atribut di HTML
        const quantity = parseInt(jumlahInput.value);

        if (bukuId && quantity > 0) {
            const newRow = document.createElement('tr');
            newRow.innerHTML = `
            <td class="py-2 px-1 border-b border-gray-300">${bukuId}</td>
            <td class="py-2 px-1 border-b border-gray-300">${bukuName}</td>
            <td class="py-2 px-1 border-b border-gray-300">${quantity}</td>
            <td class="px-1 py-2 border-b border-gray-300">
                <button type="button" class="text-red-500 remove-buku">Hapus</button>
            </td>
        `;

            bukuTable.appendChild(newRow);

            // Update hidden input for bukus
            const currentBukus = JSON.parse(bukusInput.value || "[]");
            currentBukus.push({
                buku_id: bukuId,
                buku_judul: bukuName,
                jumlah: quantity
            });
            bukusInput.value = JSON.stringify(currentBukus);

            // Clear the selection and input
            bukuSelect.value = '';
            jumlahInput.value = '';
        } else {
            alert('Silakan pilih buku dan masukkan jumlah yang valid.');
        }
    });

    // Remove buku event
    document.getElementById('bukuTable').addEventListener('click', function(event) {
        if (event.target.classList.contains('remove-buku')) {
            const row = event.target.closest('tr');
            const bukuId = row.children[0].textContent;

            // Update hidden inputs
            const bukusInput = document.getElementById('bukus');
            const currentBukus = JSON.parse(bukusInput.value || "[]");
            const updatedBukus = currentBukus.filter(buku => buku.buku_id !== bukuId);
            bukusInput.value = JSON.stringify(updatedBukus);

            row.remove();
        }
    });

    // Cancel button reset
    document.getElementById('cancelBtn').addEventListener('click', function() {
        // Reset buku select and quantity
        document.getElementById('bukuSelect').value = '';
        document.getElementById('jumlahInput').value = '';

        // Clear the buku table
        const bukuTableBody = document.querySelector('#bukuTable tbody');
        bukuTableBody.innerHTML = '';

        // Reset hidden inputs
        document.getElementById('bukus').value = '[]';

        console.log('Semua form telah direset.');
    });
    </script>

</body>

</html>