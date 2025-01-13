<?php
require '../includes/config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $conn->real_escape_string($_POST['username']);
    $password = $conn->real_escape_string($_POST['password']);

    $sql = "SELECT * FROM users WHERE username = '$username'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        //verifiakasi password
        if (password_verify($password, $user['password'])) {
        echo "login berhasil";
            header(" Location: ../views/home.php ");
            // Anda bisa menyimpan informasi pengguna dalam sesi atau melakukan redirect ke halaman lain
        } else {
            echo "Login Gagal!";
        }
    } else {
        echo "User tidak invalid!";
    }
$conn->close();
}
?>
