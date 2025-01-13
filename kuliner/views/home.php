<?php
// Menghubungkan ke database
include "includes/config.php";
include "includes/Parsedown.php";

// Membuat instance Parsedown
$parsedown = new Parsedown();
$parsedown->setMarkupEscaped(false);  // Mengaktifkan HTML dalam Markdown


// Ambil data makanan dan minuman
$query = "SELECT * FROM tbl_makanan";
$result_makanan = mysqli_query($conn, $query);

$query2 = "SELECT * FROM tbl_minuman";
$result_minuman = mysqli_query($conn, $query2);
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link href="assets/css/custom.css" rel="stylesheet"> -->
</head>

<body>
    <!-- Hero Section -->
    <section class="hero-section" style="background-image: url('images/g/hero.gif'); background-size: cover; background-position: center;">
    <div class="overlay"></div>
        <div class="container">
            <div class="hero-content">
                <h1 class="display-4 fw-bold mb-4">Warisan Kuliner Indonesia</h1>
                <hr>
                <p class="lead mb-4">Menjelajahi Kekayaan Rasa dan Tradisi Nusantara</p>
                <a href="#menu" class="btn custom-button custom-button-primary btn-lg">
                    <i class="bi bi-arrow-down-circle me-2"></i>Jelajahi Menu
                </a>
            </div>
        </div>
    </section>


<!-- Menu Cards -->
<section id="menu" class="py-5 scroll-offset">
    <div class="container">
        <h2 class="text-center mb-5">Menu Tertambah</h2>
        <div class="row g-4">
            <?php
            // Menampilkan makanan
            while ($makanan = mysqli_fetch_assoc($result_makanan)) {
                echo '<div class="col-md-4">
                        <div class="custom-card card fade-in">
                            <img src="data:image/jpeg;base64,' . base64_encode($makanan['gambar_makanan']) . '" class="card-img-top" alt="' . $makanan['nama_makanan'] . '">
                            <div class="card-body">
                                <h5 class="card-title">' . $makanan['nama_makanan'] . '</h5>
                                <p class="card-text">Hidangan khas dari ' . $makanan['daerah_makanan'] . '</p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <span class="badge bg-warning text-dark">' . $makanan['daerah_makanan'] . '</span>
                                    <!-- Tombol Detail -->
                                    <button class="btn custom-button custom-button-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modal' . $makanan['id_makanan'] . '">
                                        <i class="bi bi-info-circle me-1"></i>Detail
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>';

                // Modal untuk setiap makanan
                echo '<!-- Modal Detail -->
                <div class="modal fade" id="modal' . $makanan['id_makanan'] . '" tabindex="-1" aria-labelledby="modalLabel' . $makanan['id_makanan'] . '" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="modalLabel' . $makanan['id_makanan'] . '">' . $makanan['nama_makanan'] . '</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <!-- Gambar dan Keterangan Makanan -->
                                <img src="data:image/jpeg;base64,' . base64_encode($makanan['gambar_makanan']) . '" class="img-fluid mb-3" alt="' . $makanan['nama_makanan'] . '"><hr>
                                <p><strong>Keterangan:</strong> ' . $parsedown->text($makanan['keterangan']) . '</p> <!-- Menampilkan keterangan -->
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                            </div>
                        </div>
                    </div>
                </div>';
            }

            // Menampilkan minuman
            while ($minuman = mysqli_fetch_assoc($result_minuman)) {
                echo '<div class="col-md-4">
                        <div class="custom-card card fade-in">
                            <img src="data:image/jpeg;base64,' . base64_encode($minuman['gambar_minuman']) . '" class="card-img-top" alt="' . $minuman['nama_minuman'] . '">
                            <div class="card-body">
                                <h5 class="card-title">' . $minuman['nama_minuman'] . '</h5>
                                <p class="card-text">Hidangan khas dari ' . $minuman['daerah_minuman'] . '</p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <span class="badge bg-warning text-dark">' . $minuman['daerah_minuman'] . '</span>
                                    <!-- Tombol Detail -->
                                    <button class="btn custom-button custom-button-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modal' . $minuman['id_minuman'] . '">
                                        <i class="bi bi-info-circle me-1"></i>Detail
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>';

                // Modal untuk setiap minuman
                echo '<!-- Modal Detail -->
                <div class="modal fade" id="modal' . $minuman['id_minuman'] . '" tabindex="-1" aria-labelledby="modalLabel' . $minuman['id_minuman'] . '" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="modalLabel' . $minuman['id_minuman'] . '">' . $minuman['nama_minuman'] . '</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <!-- Gambar dan Keterangan minuman -->
                                <img src="data:image/jpeg;base64,' . base64_encode($minuman['gambar_minuman']) . '" class="img-fluid mb-3" alt="' . $minuman['nama_minuman'] . '">
                                <p><strong>Keterangan:</strong> ' . $parsedown->text($minuman['keterangan']) . '</p> <!-- Menampilkan keterangan -->
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                            </div>
                        </div>
                    </div>
                </div>';
            }
                ?>
            </div>
        </div>
    </section>
</body>

</html>