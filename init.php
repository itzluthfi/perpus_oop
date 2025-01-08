<?php

session_start();
include_once "./models/modelBuku.php";
include_once "./models/modelUser.php";
include_once "./models/modelPeminjaman.php";


// initiate
// $modelRole = new modelRole();
$modelUser = new modelUser();
$modelBuku = new modelBuku();
$modelPeminjaman = new modelPeminjaman();




?>