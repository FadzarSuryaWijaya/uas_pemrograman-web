<?php
require '../includes/config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $conn->real_escape_string($_POST['username']);
    $password = password_hash($conn->real_escape_string($_POST['password']), PASSWORD_BCRYPT);

    $sql = "INSERT INTO users (username, password) 
                VALUES ('$username', '$password')";

if (mysqli_query($conn, $sql)) {
    header("Location: ../views/loginview.php");
}   else {
        echo "pendaftaran gagal : " . mysqli_error($conn);
}
$conn->close();
}

?>