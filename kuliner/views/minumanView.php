<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar minuman Tradisional</title>
</head>
<body>
<div class="container mt-5">
    <div class="card-header">
        <h5 class="float-start mt-2 fw-bold">Daftar minuman Tradisional</h5><br>
        <div class="float-end mt-2">
            <a href="?page=minumanAdd&id" class="btn btn-sm btn-success">Tambah Data</a>
        </div>
    </div>

    <table id="minumanTable" class="table table-striped table-bordered mt-3">
        <thead>
            <tr>
                <th>No.</th>
                <th>Nama minuman</th>
                <th>Asal Daerah</th>
                <th>Keterangan</th>
                <th>Gambar</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Ambil data dari database
            $query = "SELECT * FROM tbl_minuman ORDER BY id_minuman ASC";
            $sql = mysqli_query($conn, $query);
            $nomor = 1;
            while ($val = mysqli_fetch_assoc($sql)) { ?>
                <tr>
                    <td><?= $nomor++; ?></td>
                    <td><?= $val['nama_minuman']; ?></td>
                    <td><?= $val['daerah_minuman']; ?></td>
                    <td><?= $val['keterangan']; ?></td>
                    <td>
                        <?php
                        // Mengecek apakah ada gambar
                        if ($val['gambar_minuman']) {
                            // Mengambil data gambar BLOB dari database
                            $gambar_minuman = $val['gambar_minuman'];
                            // Mengonversi gambar biner menjadi base64
                            // Tentukan format gambar berdasarkan ekstensi
                            $ext = pathinfo($val['gambar_minuman'], PATHINFO_EXTENSION);
                            // Set MIME type berdasarkan ekstensi file gambar
                            if ($ext == 'jpg' || $ext == 'jpeg') {
                                $mime_type = 'image/jpeg';
                            } elseif ($ext == 'png') {
                                $mime_type = 'image/png';
                            } else {
                                $mime_type = 'image/jpeg'; // Default to JPEG if the format is unknown
                            }
                            // Mengonversi gambar biner menjadi base64
                            $gambar_base64 = base64_encode($gambar_minuman);
                            $gambar_src = 'data:' . $mime_type . ';base64,' ;

                            // Menampilkan gambar menggunakan base64
                            echo '<img src=" ' . $gambar_src . $gambar_base64 .' " alt=" ' . $val['nama_minuman'] . '" class="img-thumbnail" style="width: 100px; height: 100px;">';
                        } else {
                            // Jika tidak ada gambar, tampilkan placeholder
                            echo 'Tidak ada gambar';
                        }
                        ?>
                    </td>
                    <td>
                        <div >
                            <a href="?page=minumanUpdate&id=<?= $val['id_minuman']; ?>" class="btn btn-warning btn-sm mx-3">Update</a>
                            <a href="?page=minumanDelete&id=<?= $val['id_minuman']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus data ini?');">Hapus</a>
                        </div>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

<script>
    $(document).ready(function() {
        $('#minumanTable').DataTable({
            pageLength: 5, // Menampilkan 5 data per halaman
            lengthMenu: [5, 10, 25, 50, 100], // Opsi jumlah halaman
            createdRow: function(row, data, dataIndex) {
                // Membatasi panjang kolom Keterangan
                var keterangan = $(row).find('td:eq(3)').text(); // Kolom Keterangan (indeks 3)
                if (keterangan.length > 200) { // Batasi hanya 100 karakter
                    $(row).find('td:eq(3)').text(keterangan.substr(0, 200) + '...');
                }
            }
        });
    });
</script>
</body>
</html>
