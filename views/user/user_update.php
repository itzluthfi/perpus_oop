<?php
    require_once "/laragon/www/laundry_shoes/init.php";

    $obj_user = $modelUser->getUserById($_GET['id']);
   
    $obj_roles = $modelRole->getAllRoleFromDB();
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Input User</title>
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
            <!-- Formulir Input User -->
            <div class="max-w-lg mx-auto bg-white p-6 rounded-lg shadow-lg">
                <h2 class="text-2xl font-bold mb-6 text-gray-800">Update User</h2>
                <form action="../../response_input.php?modul=user&fitur=update&id=<?= $obj_user->user_id ?>"
                    method="POST">
                    <!-- user id(hidden) -->
                    <!-- <input type="hidden" name="user_id" value="<?= $obj_user->user_id ?>"> -->
                    <!-- Nama User -->
                    <div class="mb-4">
                        <label for="user_username" class="block text-gray-700 text-sm font-bold mb-2">Nama User:</label>
                        <input type="text" id="user_username" name="user_username"
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                            placeholder="Masukkan Nama User" value="<?= $obj_user->user_username ?>" required>
                    </div>


                    <!-- Password User -->
                    <div class="mb-4">
                        <label for="user_password" class="block text-gray-700 text-sm font-bold mb-2">Password:</label>
                        <input type="password" id="user_password" name="user_password"
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                            placeholder="Masukkan Password" value="<?= $obj_user->user_password ?>" required>
                    </div>

                    <!-- Role User -->
                    <div class="mb-4">
                        <label for="id_role" class="block text-gray-700 text-sm font-bold mb-2">Role User:</label>
                        <select id="id_role" name="id_role"
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                            required>
                            <option value="<?= $obj_user->id_role ?>">Pilih Role</option>
                            <?php foreach($obj_roles as $role) {
                                if($role->role_status == 1) { ?>
                            <option value="<?= $role->role_id ?>"><?= $role->role_nama ?></option>
                            <?php } } ?>
                        </select>
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