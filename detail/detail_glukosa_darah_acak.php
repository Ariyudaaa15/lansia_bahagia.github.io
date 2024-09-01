<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Glukosa Darah Acak</title>
    <link rel="stylesheet" href="../assets/dist/bootstrap.min.css">
    <script src="../assets/dist/sweetalert2.all.min.js"></script>
</head>
<body>

<div class="container mt-4">
    <div class="shadow p-3 bg-white rounded">
        <h5><b>Selamat Datang Di Halaman Detail Glukosa Darah Acak</b></h5>
    </div>

    <?php 
    include '../koneksi/konek.php';

    // Ambil ID glukosa darah acak dari URL dan pastikan nilainya ada
    $id_glukosa_darah_acak = $_GET['id'] ?? null;

    // Periksa apakah ID valid
    if ($id_glukosa_darah_acak) {
        // Ambil data detail glukosa darah acak berdasarkan ID
        $ambil = mysqli_query($koneksi, "SELECT ga.*, l.nama_lengkap 
                                         FROM glukosa_darah_acak ga 
                                         JOIN lansia l ON ga.id_lansia = l.id_lansia 
                                         WHERE ga.id_glukosa_darah_acak='$id_glukosa_darah_acak'");
        // Cek apakah query berhasil
        if ($ambil) {
            $detailglukosaacak = mysqli_fetch_assoc($ambil);

            // Cek apakah data ditemukan
            if (!$detailglukosaacak) {
                echo "<div class='alert alert-danger'>Data glukosa acak tidak ditemukan.</div>";
                exit;
            }
        } else {
            // Tampilkan pesan jika query gagal
            echo "<div class='alert alert-danger'>Terjadi kesalahan saat mengambil data: " . mysqli_error($koneksi) . "</div>";
            exit;
        }
    } else {
        echo "<div class='alert alert-danger'>ID glukosa acak tidak valid.</div>";
        exit;
    }
    ?>

    <div class="card shadow bg-white mt-3">
        <div class="card-header">
            <strong>Data Glukosa Darah Acak</strong>
        </div>
        <div class="card-body">

            <div class="form-group row">
                <label class="col-sm-3 col-form-label">Nama Lengkap :</label>
                <div class="col-sm-9">
                    <input disabled class="form-control" value="<?php echo htmlspecialchars($detailglukosaacak['nama_lengkap']); ?>">
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-3 col-form-label">Kadar Glukosa Darah Acak (mg/dL) :</label>
                <div class="col-sm-9">
                    <input disabled class="form-control" value="<?php echo htmlspecialchars($detailglukosaacak['kadar_glukosa']); ?>">
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-3 col-form-label">Tanggal Pengukuran :</label>
                <div class="col-sm-9">
                    <input disabled class="form-control" value="<?php echo htmlspecialchars($detailglukosaacak['tanggal_pengukuran']); ?>">
                </div>
            </div>

        </div>

        <div class="card-footer">
            <div class="row">
                <div class="col-md-11">
                    <a href="index.php?halaman=edit_glukosa_darah_acak&id_glukosa_darah_acak=<?php echo $detailglukosaacak['id_glukosa_darah_acak']; ?>" class="btn btn-warning">Edit Data</a>
                </div>
                <div class="col-md-1 text-right">
                    <a href="index.php?halaman=glukosa_darah_acak" class="btn btn-danger">Kembali</a>
                </div>
            </div>
        </div>
    </div>

</div>

</body>
</html>
