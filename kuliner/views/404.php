<?php
// Header untuk memberitahu bahwa ini adalah halaman error 404
header("HTTP/1.1 404 Not Found");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 Not Found</title>
    <style>
        /* Reset margin dan padding */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        /* Latar belakang hitam ala Netflix */
        body {
            background-color: #141414;
            color: white;
            font-family: Arial, sans-serif;
            text-align: center;
        }

        /* Container untuk 404 message */
        .container {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            text-align: center;
            width: 80%;
            max-width: 600px;
        }

        /* Gambar besar di belakang (background) */
        .bg-image {
            background-size: contain;
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            z-index: -1; /* Agar gambar tetap di belakang konten */
        }

        h1 {
            font-size: 120px;
            margin-bottom: 20px;
            color: #e50914; /* Warna merah Netflix */
        }

        p {
            font-size: 24px;
            color: #b3b3b3;
            margin-bottom: 30px;
        }

        .btn {
            padding: 12px 30px;
            font-size: 18px;
            background-color: #e50914;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .btn:hover {
            background-color: #f40612;
        }
    </style>
</head>
<body>

    <!-- Latar belakang gambar -->
    <div class="bg-image"></div>

    <div class="container">
        <h1>404</h1>
        <p>Sorry, we couldn't find the page you're looking for.</p>
        <a href="/kuliner/" class="btn">Back to Home</a>
    </div>

</body>
</html>
