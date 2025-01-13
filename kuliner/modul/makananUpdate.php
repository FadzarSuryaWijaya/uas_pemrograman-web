<?php
include "includes/config.php";

// Ambil ID dari query string
$id = $_GET['id'];

// Buat query untuk ambil data dari database
$query = "SELECT * FROM tbl_makanan WHERE id_makanan=?";
$stmt = mysqli_prepare($conn, $query);
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$data = mysqli_fetch_assoc($result);

// Jika data yang di-edit tidak ditemukan
if (!$data) {
    die("Data tidak ditemukan...");
}

// Skrip Proses Update
if (isset($_POST['update'])) {
    // Ambil data dari formulir dan sanitasi input
    $nama_makanan = mysqli_real_escape_string($conn, $_POST['nama_makanan']);
    $daerah_makanan = mysqli_real_escape_string($conn, $_POST['daerah_makanan']);
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

            // Update data termasuk gambar BLOB
            $query = "UPDATE tbl_makanan SET nama_makanan = ?, daerah_makanan = ?, keterangan = ?, gambar_makanan = ? WHERE id_makanan = ?";
            $stmt = mysqli_prepare($conn, $query);
            mysqli_stmt_bind_param($stmt, "ssssi", $nama_makanan, $daerah_makanan, $keterangan, $gambar_data, $id);
        } else {
            echo "<script>window.alert('Hanya file gambar (JPEG/PNG) yang diperbolehkan dan maksimal 2MB!'); window.location='?page=makanan';</script>";
            exit;
        }
    } else {
        // Jika tidak ada gambar baru, update data tanpa mengubah gambar
        $query = "UPDATE tbl_makanan SET nama_makanan = ?, daerah_makanan = ?, keterangan = ? WHERE id_makanan = ?";
        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, "sssi", $nama_makanan, $daerah_makanan, $keterangan, $id);
    }

    // Eksekusi query update
    if (mysqli_stmt_execute($stmt)) {
        echo "<script>window.alert('Data berhasil diupdate!'); window.location='?page=makanan';</script>";
    } else {
        echo "<script>window.alert('Gagal update data!'); window.location='?page=makanan';</script>";
    }
}
?>

<div class="p-4">
    <div class="d-flex justify-content-center">
        <div class="row-12 w-75">
            <div class="card card-primary card-outline">
                <div class="card-header">
                    <h5 class="m-0">Update Data Daftar makanan</h5>
                </div>
                <div class="card-body">
                    <form method="post" action="" enctype="multipart/form-data">
                        <!-- menampung nilai id yang akan di edit -->
                        <input type="hidden" name="id" value="<?= $data['id_makanan'] ?>" />
                        <div class="row">
                            <div class="mb-3">
                                <label for="formGroupExampleInput" class="form-label">Nama makanan</label>
                                <input type="text" class="form-control" name="nama_makanan" value="<?= $data['nama_makanan'] ?>" required />
                            </div>
                            <div class="mb-3">
                                <label for="formGroupExampleInput2" class="form-label">Daerah makanan</label>
                                <input type="text" class="form-control" name="daerah_makanan" value="<?= $data['daerah_makanan'] ?>" required />
                            </div>
                            <div class="mb-3">
                                <label for="formGroupExampleInput3" class="form-label">Keterangan</label>
                                <textarea class="form-control" id="keterangan" name="keterangan" rows="5" required><?php echo isset($_POST['keterangan']) ? htmlspecialchars($_POST['keterangan']) : ''; ?><?= $data['keterangan'] ?></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="gambar_makanan" class="form-label">Upload Gambar makanan</label>
                                <input type="file" class="form-control" name="gambar_makanan" />
                                <small class="form-text text-muted">Kosongkan jika tidak ingin mengubah gambar.</small>
                            </div>
                        </div>
                        <div class="row justify-content-center">
                            <button type="submit" name="update" class="btn btn-success waves-effect waves-light mx-2" style="width: 6em; height:2.4em">Update</button>
                            <a class="btn btn-primary" href="?page=makanan" role="button" style="width: 6em; height:2.4em">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>