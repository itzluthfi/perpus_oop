<?php 
//require_once "/laragon/www/laundry_shoes/model/modelRole.php"; 
require_once "../../init.php";   
// include "/laragon/www/laundry_shoes/auth_check.php";    
$obj_role = $modelRole->getAllRoleFromDB(); 
// $obj_member = $modelMember->getAllMembers(); 
// $obj_item = $modelItem->getAllItem(); 
// $obj_sale = $modelSale->getAllSales(); 


// Ambil tanggal dan total penjualan dari setiap objek penjualan
$obj_sale = [
    (object)[
        'sale_id' => 1,
        'sale_date' => '2025-01-02',
        'sale_totalPrice' => 150000,
        'sale_pay' => 200000,
        'sale_change' => 50000,
        'id_user' => 1,
        'id_member' => 1,
        'detailSale' => [
            (object)[
                'item_id' => 101,
                'item_name' => 'Cuci Mobil',
                'item_price' => 50000,
                'item_qty' => 1,
                'subtotal' => 50000,
            ],
            (object)[
                'item_id' => 102,
                'item_name' => 'Ganti Oli',
                'item_price' => 100000,
                'item_qty' => 1,
                'subtotal' => 100000,
            ],
        ],
    ],
    (object)[
        'sale_id' => 2,
        'sale_date' => '2025-01-03',
        'sale_totalPrice' => 75000,
        'sale_pay' => 100000,
        'sale_change' => 25000,
        'id_user' => 2,
        'id_member' => 2,
        'detailSale' => [
            (object)[
                'item_id' => 103,
                'item_name' => 'Salon Mobil',
                'item_price' => 75000,
                'item_qty' => 1,
                'subtotal' => 75000,
            ],
        ],
    ],
    (object)[
        'sale_id' => 3,
        'sale_date' => '2025-01-04',
        'sale_totalPrice' => 200000,
        'sale_pay' => 250000,
        'sale_change' => 50000,
        'id_user' => 3,
        'id_member' => 3,
        'detailSale' => [
            (object)[
                'item_id' => 104,
                'item_name' => 'Paket Lengkap Cuci + Salon',
                'item_price' => 200000,
                'item_qty' => 1,
                'subtotal' => 200000,
            ],
        ],
    ],
];


$sales_dates = [];
$sales_totals = [];
foreach ($obj_sale as $sale) {
    $sales_dates[] = $sale->sale_date; // Asumsi ada field sale_date
    $sales_totals[] = $sale->sale_totalPrice;
}

// Menghitung total penjualan
$total_sales = 0;
foreach ($obj_sale as $sale) {
    $total_sales += $sale->sale_totalPrice;
}

//information label card
$non_active_roles = [];
foreach ($obj_role as $role) {
    if (!$role->role_status) {
        $non_active_roles[] = $role;
    }
}

$layanan = [
    ['id' => 1, 'nama' => 'Layanan Cuci Mobil', 'harga' => 50000],
    ['id' => 2, 'nama' => 'Layanan Salon Mobil', 'harga' => 150000],
    ['id' => 3, 'nama' => 'Layanan Ganti Oli', 'harga' => 75000],
];

// Data dummy untuk reservasi
$reservasi = [
    ['id' => 1, 'nama_pelanggan' => 'John Doe', 'layanan' => 'Cuci Mobil', 'jadwal' => '2025-01-03 10:00:00'],
    ['id' => 2, 'nama_pelanggan' => 'Jane Smith', 'layanan' => 'Salon Mobil', 'jadwal' => '2025-01-03 14:00:00'],
    ['id' => 3, 'nama_pelanggan' => 'Michael Brown', 'layanan' => 'Ganti Oli', 'jadwal' => '2025-01-04 09:30:00'],
];


// Encode data untuk digunakan di JavaScript
$sales_dates_json = json_encode($sales_dates);
$sales_totals_json = json_encode($sales_totals);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@latest/dist/full.css" rel="stylesheet" type="text/css" />
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.0/css/all.min.css">
</head>
<style>
.w-Search-Input {
    width: 400px;
}
</style>

<body class="bg-yellow-100 font-sans leading-normal tracking-normal overflow-hidden">

    <!-- Navbar -->
    <?php include_once '../includes/navbar.php'; ?>

    <!-- Main container -->
    <div class="flex h-screen">
        <!-- Sidebar -->

        <?php include_once '../includes/sidebar.php'; ?>




        <!-- Main Content -->


        <!-- Page content -->
        <div class="p-6">
            <h2 class="text-3xl font-bold mb-6 text-gray-800">Ringkasan</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <div class="stat bg-white shadow-lg rounded-lg">
                    <div class="stat-figure text-primary">
                        <i class="fas fa-users text-4xl"></i>
                    </div>
                    <div class="stat-title text-gray-600">Total Pengguna</div>
                    <div class="stat-value text-primary">1,200</div>
                    <div class="stat-desc">↗︎ 40 (3%)</div>
                </div>
                <div class="stat bg-white shadow-lg rounded-lg">
                    <div class="stat-figure text-secondary">
                        <i class="fas fa-user-tag text-4xl"></i>
                    </div>
                    <div class="stat-title text-gray-600">Jumlah Role</div>
                    <div class="stat-value text-secondary">5</div>
                    <div class="stat-desc">↘︎ 1 (20%)</div>
                </div>
                <div class="stat bg-white shadow-lg rounded-lg">
                    <div class="stat-figure text-accent">
                        <i class="fas fa-book-reader text-4xl"></i>
                    </div>
                    <div class="stat-title text-gray-600">Peminjaman Aktif</div>
                    <div class="stat-value text-accent">150</div>
                    <div class="stat-desc">↗︎ 25 (20%)</div>
                </div>
                <div class="stat bg-white shadow-lg rounded-lg">
                    <div class="stat-figure text-info">
                        <i class="fas fa-book text-4xl"></i>
                    </div>
                    <div class="stat-title text-gray-600">Total Buku</div>
                    <div class="stat-value text-info">5,000</div>
                    <div class="stat-desc">↗︎ 200 (4%)</div>
                </div>
            </div>
            <div class="mt-8">
                <h3 class="text-2xl font-bold mb-4 text-gray-800">Aktivitas Terbaru</h3>
                <div class="overflow-x-auto bg-white shadow-lg rounded-lg">
                    <table class="table w-full">
                        <thead>
                            <tr>
                                <th>Pengguna</th>
                                <th>Aktivitas</th>
                                <th>Waktu</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <div class="flex items-center space-x-3">
                                        <div class="avatar">
                                            <div class="mask mask-squircle w-12 h-12">
                                                <img src="https://api.dicebear.com/6.x/initials/svg?seed=John"
                                                    alt="Avatar" />
                                            </div>
                                        </div>
                                        <div>
                                            <div class="font-bold">John Doe</div>
                                            <div class="text-sm opacity-50">Mahasiswa</div>
                                        </div>
                                    </div>
                                </td>
                                <td>Meminjam buku "Algoritma dan Struktur Data"</td>
                                <td>10 menit yang lalu</td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="flex items-center space-x-3">
                                        <div class="avatar">
                                            <div class="mask mask-squircle w-12 h-12">
                                                <img src="https://api.dicebear.com/6.x/initials/svg?seed=Jane"
                                                    alt="Avatar" />
                                            </div>
                                        </div>
                                        <div>
                                            <div class="font-bold">Jane Smith</div>
                                            <div class="text-sm opacity-50">Dosen</div>
                                        </div>
                                    </div>
                                </td>
                                <td>Mengembalikan buku "Artificial Intelligence"</td>
                                <td>1 jam yang lalu</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="drawer-side">
        <label for="my-drawer-2" class="drawer-overlay"></label>
        <ul class="menu p-4 w-80 h-full bg-base-200 text-base-content">
            <li class="mb-4">
                <div class="flex items-center space-x-3">
                    <div class="avatar">
                        <div class="mask mask-squircle w-12 h-12">
                            <img src="https://api.dicebear.com/6.x/initials/svg?seed=Admin" alt="Admin Avatar" />
                        </div>
                    </div>
                    <div>
                        <div class="font-bold">Admin</div>
                        <div class="text-sm opacity-50">Super Admin</div>
                    </div>
                </div>
            </li>
            <li><a class="active"><i class="fas fa-tachometer-alt mr-2"></i>Dashboard</a></li>
            <li><a><i class="fas fa-users mr-2"></i>Pengguna</a></li>
            <li><a><i class="fas fa-user-tag mr-2"></i>Role</a></li>
            <li><a><i class="fas fa-book-reader mr-2"></i>Peminjaman</a></li>
            <li><a><i class="fas fa-book mr-2"></i>Buku</a></li>
            <li><a><i class="fas fa-chart-bar mr-2"></i>Laporan</a></li>
            <li><a><i class="fas fa-cog mr-2"></i>Pengaturan</a></li>
        </ul>
    </div>
    </div>
</body>

</html>



<!-- Modal untuk detail sale -->
<?php if (!empty($obj_sale)) {
            foreach ($obj_sale as $sale) { ?>
<div id="modal-<?php echo $sale->sale_id; ?>"
    class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden">
    <div class="relative top-20 mx-auto p-5 border w-1/2 shadow-lg rounded-md bg-white">
        <div class="mt-3 text-center">
            <h3 class="text-lg leading-6 font-medium text-gray-900">Detail sale:
                <?php echo htmlspecialchars($sale->sale_id); ?></h3>
            <div class="mt-2">
                <table class="min-w-full bg-white overflow-y-auto overflow-x-auto">
                    <thead class="bg-gray-800 text-white">
                        <tr>
                            <th class="w-1/8 py-3 px-4 uppercase font-semibold text-sm">Id</th>
                            <th class="w-1/4 py-3 px-4 uppercase font-semibold text-sm">Barang</th>
                            <th class="w-1/4 py-3 px-4 uppercase font-semibold text-sm">Harga</th>
                            <th class="w-1/4 py-3 px-4 uppercase font-semibold text-sm">Jumlah</th>
                            <th class="w-1/4 py-3 px-4 uppercase font-semibold text-sm">Sub Total</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-700">
                        <?php foreach ($sale->detailSale as $detail) { ?>
                        <tr class="text-center">
                            <td class="py-3 px-2"><?php echo htmlspecialchars($detail->item_id); ?></td>
                            <td class="py-3 px-3"><?php echo htmlspecialchars($detail->item_name); ?>
                            </td>
                            <td class="py-3 px-4"><?php echo htmlspecialchars($detail->item_price); ?>
                            </td>
                            <td class="py-3 px-4"><?php echo htmlspecialchars($detail->item_qty); ?>
                            </td>
                            <td class="py-3 px-4"><?php echo htmlspecialchars($detail->subtotal); ?>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
            <div class="items-center px-4 py-3">
                <button class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded"
                    onclick="closeModal('modal-<?php echo $sale->sale_id; ?>')">
                    Close
                </button>
            </div>
        </div>
    </div>
</div>
<?php } } ?>

</div>


<script>
// Ambil data dari PHP
const salesDates = <?php echo $sales_dates_json; ?>;
const salesTotals = <?php echo $sales_totals_json; ?>;

// Konfigurasi data chart menggunakan data dari PHP
const salesData = {
    labels: salesDates,
    datasets: [{
        label: 'Total Penjualan (USD)',
        data: salesTotals,
        backgroundColor: 'rgba(99, 102, 241, 0.2)', // Background warna Indigo
        borderColor: 'rgba(99, 102, 241, 1)', // Border warna Indigo
        borderWidth: 1
    }]
};

// Konfigurasi dan render chart
const salesConfig = {
    type: 'line',
    data: salesData,
    options: {
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
};

const salesChart = new Chart(
    document.getElementById('salesChart'),
    salesConfig
);
</script>


<script>
function openModal(id) {
    const modal = document.getElementById(id);
    if (modal) {
        modal.classList.remove('hidden');
    } else {
        console.error('Modal not found: ', id);
    }
}


function closeModal(id) {
    document.getElementById(id).classList.add('hidden');
}

// function confirmDelete(saleId) {
//     if (confirm('Apakah Anda yakin ingin menghapus role ini?')) {
//         // Redirect ke halaman delete dengan fitur=delete
//         window.location.href = "/laundry_shoes/response_input.php?modul=sale&fitur=delete&id=" + saleId;
//     } else {
//         // Batalkan penghapusan
//         alert("gagal menghapus data");
//         return false;
//     }
// }
</script>

</body>

</html>