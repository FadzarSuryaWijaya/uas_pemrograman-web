<?php
// Cek apakah tombol simpan sudah diklik atau belum?
if (isset($_POST['submit'])) {
    // Ambil data dari formulir dan sanitasi input untuk mencegah SQL Injection
    $nama_makanan = mysqli_real_escape_string($conn, $_POST['nama_makanan']);
    $daerah_makanan = mysqli_real_escape_string($conn, $_POST['daerah_makanan']);
// Saat menerima input dari form replace /r/n dengan spasi
$keterangan = mysqli_real_escape_string($conn, str_replace(array("\r\n", "\r", "\n"), " ", $_POST['keterangan']));

    // Ambil data gambar
    $gambar_makanan = $_FILES['gambar_makanan']['name'];
    $gambar_tmp = $_FILES['gambar_makanan']['tmp_name'];

    // Validasi gambar (tipe dan ukuran file)
    $allowed_types = ['image/jpeg', 'image/png'];
    $max_size = 2 * 1024 * 1024; // Maksimal 2MB

    if ($gambar_makanan) {
        $gambar_type = $_FILES['gambar_makanan']['type'];
        $gambar_size = $_FILES['gambar_makanan']['size'];

        // Cek apakah file gambar valid
        if ($gambar_size <= $max_size && in_array($gambar_type, $allowed_types)) {
            // Mengambil gambar sebagai data biner
            $gambar_data = file_get_contents($gambar_tmp);

            // Siapkan query untuk menyimpan data makanan dan gambar dalam database
            $query = "INSERT INTO tbl_makanan (nama_makanan, daerah_makanan, keterangan, gambar_makanan) VALUES (?, ?, ?, ?)";
            if ($stmt = mysqli_prepare($conn, $query)) {
                // Mengikat parameter gambar sebagai data biner (tipe 'b' untuk BLOB)
                mysqli_stmt_bind_param($stmt, "ssss", $nama_makanan, $daerah_makanan, $keterangan, $gambar_data);
                // mysqli_stmt_send_long_data($stmt, 3, $gambar_data);
                // Eksekusi query
                if (mysqli_stmt_execute($stmt)) {
                    echo "<script>window.alert('Data berhasil ditambah!'); window.location='?page=makanan';</script>";
                } else {
                    echo "<script>window.alert('Gagal menambah data!'); window.location='?page=makanan';</script>";
                }
                mysqli_stmt_close($stmt);
            }
        } else {
            echo "<script>window.alert('Hanya file gambar (JPEG/PNG) yang diperbolehkan dan maksimal 2MB!'); window.location='?page=makanan';</script>";
        }
    } else {
        // Jika tidak ada gambar, simpan data tanpa gambar
        $query = "INSERT INTO tbl_makanan (nama_makanan, daerah_makanan, keterangan) VALUES (?, ?, ?)";
        if ($stmt = mysqli_prepare($conn, $query)) {
            mysqli_stmt_bind_param($stmt, "sss", $nama_makanan, $daerah_makanan, $keterangan);
            // Kirim data biner (gambar) secara bertahap
            if (mysqli_stmt_execute($stmt)) {
                echo "<script>window.alert('Data berhasil ditambah!'); window.location='?page=makanan';</script>";
            } else {
                echo "<script>window.alert('Gagal menambah data!'); window.location='?page=makanan';</script>";
            }
            mysqli_stmt_close($stmt);
        }
    }
    exit;
}
?>

<div class="p-4">
    <div class="d-flex justify-content-center">
        <div class="row-12 w-75">
            <div class="card card-primary card-outline">
                <div class="card-header">
                    <h5 class="m-0">Tambah Data Daftar makanan</h5>
                </div>
                <div class="card-body">
                    <form method="post" action="" enctype="multipart/form-data">
                        <div class="row">
                            <div class="mb-3">
                                <label for="formGroupExampleInput" class="form-label">Nama makanan</label>
                                <input type="text" class="form-control" name="nama_makanan" required>
                            </div>
                            <div class="mb-3">
                                <label for="formGroupExampleInput2" class="form-label">Daerah makanan</label>
                                <input type="text" class="form-control" name="daerah_makanan" required>
                            </div>
                            <div class="mb-3">
                                <label for="formGroupExampleInput3" class="form-label">Keterangan</label>
                                <textarea type= "text" class="form-control"  name="keterangan" rows="5" required><?php echo isset($_POST['keterangan']) ? htmlspecialchars($_POST['keterangan']) : ''; ?></textarea>
                                </textarea>
                            </div>
                            <div class="mb-3">
                                <label for="gambar_makanan" class="form-label">Upload Gambar makanan</label>
                                <input type="file" class="form-control" name="gambar_makanan" />
                                <small class="form-text text-muted">Kosongkan jika tidak ingin mengupload gambar.</small>
                            </div>
                        </div>
                        <div class="row justify-content-center">
                            <button type="submit" name="submit" class="btn btn-success waves-effect waves-light mx-0" style="width: 6em; height:2.4em">Submit</button>
                            <input class="btn btn-warning mx-2" type="reset" value="Reset" style="width: 6em; height:2.4em">
                            <a class="btn btn-primary" href="?page=makanan" role="button" style="width: 6em; height:2.4em">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>