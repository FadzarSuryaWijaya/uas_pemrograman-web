<?php
require "includes/config.php";
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Daftar Kuliner</title>
    <!-- koneksi -->
    <link href="assets/datatables/dataTables.dataTables.css" rel="stylesheet">
    <link href="assets/datatables/dataTables.bootstrap5.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/custom.css" rel="stylesheet">
    <script src="assets/jquery-3.7.1.js"></script>
    <script src="assets/datatables/dataTables.js"></script>
    <script src="assets/datatables/dataTables.bootstrap5.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
</head>

<body>
    <div class="main-content" style="text-align: center;">
        <?php require "includes/navbar.php" ?>
    </div>
    <div class="main-content" align="center">
        <?php require "includes/konten.php" ?>
    </div>
    <footer style="margin-top: 3em; text-align: center;">
        <?php require "includes/pagefooter.php" ?>
    </footer>
</body>
</html>