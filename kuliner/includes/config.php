<?php
date_default_timezone_set('Asia/Jakarta');
$servername = "localhost";
$username = "root";
$password = "";
$database = "db_kuliner";

$conn = mysqli_connect($servername, $username, $password, $database);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
