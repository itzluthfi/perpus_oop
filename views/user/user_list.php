<?php

require_once "/laragon/www/perpus_oop/init.php";

// include "/laragon/www/laundry_shoes/auth_check.php"; 


$obj_user = $modelUser->getAllUsers();
var_dump($obj_user);
?>

<!DOCTYPE html>
<html lang="en" data-theme="light">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List User</title>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@latest/dist/full.css" rel="stylesheet" type="text/css" />
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>

<body class="bg-base-200 font-sans leading-normal tracking-normal">

    <!-- Navbar -->
    <?php include_once '/laragon/www/perpus_oop/views/includes/navbar.php'; ?>

    <!-- Main container -->
    <div class="flex">
        <!-- Sidebar -->
        <?php include_once "/laragon/www/perpus_oop/views/includes/sidebar.php"; ?>

        <!-- Main Content -->
        <div class="flex-1 p-8">
            <div class="container mx-auto overflow-y-auto h-[calc(100vh-4rem)]">
                <div class="bg-base-100 shadow-xl rounded-box p-6">
                    <h1 class="text-4xl font-bold mb-6 text-primary">Manage User</h1>

                    <div class="flex justify-between items-center mb-6">
                        <div class="form-control">
                            <input id="search-input" type="text" name="query" placeholder="Search By Username Or ID"
                                class="input input-bordered w-full max-w-xs" />
                        </div>

                        <button class="btn btn-primary">
                            <i class="fa-solid fa-plus mr-2"></i>
                            <a href="/laundry_shoes/views/user/user_input.php">Add New User</a>
                        </button>
                    </div>

                    <!-- Users Table -->
                    <div class="overflow-x-auto">
                        <table class="table w-full">
                            <thead>
                                <tr>
                                    <th>User ID</th>
                                    <th>Username</th>
                                    <th>Password</th>
                                    <th>Role</th>
                                    <th>No Telp</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($obj_user as $user){ 
                                    $user_role = $modelRole->getRoleById($user->role_id);
                                ?>
                                <tr>
                                    <td class="text-primary font-medium"><?= $user->id ?></td>
                                    <td><?= $user->user_username ?></td>
                                    <td><?= $user->user_password ?></td>
                                    <td><span class="badge badge-ghost"><?= $user_role->role_nama ?></span></td>
                                    <td><?= $user->no_telp ?></td>
                                    <td>
                                        <div class="btn-group">
                                            <a href="/laundry_shoes/views/user/user_update.php?id=<?= $user->id ?>"
                                                class="btn btn-sm btn-warning">
                                                <i class="fa-regular fa-pen-to-square"></i>
                                            </a>
                                            <button class="btn btn-sm btn-error"
                                                onclick="return confirmDelete(<?= $user->id ?>)">
                                                <i class="fa-solid fa-trash"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
    function confirmDelete(userId) {
        if (confirm('Apakah Anda yakin ingin menghapus user ini?')) {
            window.location.href = "/laundry_shoes/response_input.php?modul=user&fitur=delete&id=" + userId;
        } else {
            alert("Gagal menghapus data");
            return false;
        }
    }
    </script>

</body>

</html>