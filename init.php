<?php

session_start();
include_once "models/modelBuku.php";
include_once "models/modelUser.php";
include_once "models/modelPeminjaman.php";
include_once "models/modelRole.php";
include_once "models/modelStatus.php";
include_once "models/modelCart.php";


// initiate
$modelRole = new modelRole();
$modelBuku = new modelBuku();
$modelPeminjaman = new modelPeminjaman();
$modelUser = new modelUser();
$modelStatus = new modelStatus();
$modelCart = new modelCart();




?>