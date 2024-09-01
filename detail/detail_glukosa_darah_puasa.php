<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Glukosa Darah Puasa</title>
    <link rel="stylesheet" href="../assets/dist/bootstrap.min.css">
    <script src="../assets/dist/sweetalert2.all.min.js"></script>
</head>
<body>

<div class="container mt-4">
    <div class="shadow p-3 bg-white rounded">
        <h5><b>Selamat Datang Di Halaman Detail Glukosa Darah Puasa</b></h5>
    </div>

    <?php 
    include '../koneksi/konek.php';

    // Ambil ID glukosa darah puasa dari URL dan pastikan nilainya ada
    $id_glukosa_puasa = $_GET['id'] ?? null;

    // Periksa apakah ID valid
    if ($id_glukosa_puasa) {
        // Ambil data detail glukosa darah puasa berdasarkan ID
        $ambil = mysqli_query($koneksi, "SELECT gp.*, l.nama_lengkap 
                                         FROM glukosa_darah_puasa gp 
                                         JOIN lansia l ON gp.id_lansia = l.id_lansia 
                                         WHERE gp.id_glukosa_puasa='$id_glukosa_puasa'");
        // Cek apakah query berhasil
        if ($ambil) {
            $detailglukosapuasa = mysqli_fetch_assoc($ambil);

            // Cek apakah data ditemukan
            if (!$detailglukosapuasa) {
                echo "<div class='alert alert-danger'>Data glukosa puasa tidak ditemukan.</div>";
                exit;
            }
        } else {
            // Tampilkan pesan jika query gagal
            echo "<div class='alert alert-danger'>Terjadi kesalahan saat mengambil data: " . mysqli_error($koneksi) . "</div>";
            exit;
        }
    } else {
        echo "<div class='alert alert-danger'>ID glukosa puasa tidak valid.</div>";
        exit;
    }
    ?>

    <div class="card shadow bg-white mt-3">
        <div class="card-header">
            <strong>Data Glukosa Darah Puasa</strong>
        </div>
        <div class="card-body">

            <div class="form-group row">
                <label class="col-sm-3 col-form-label">Nama Lengkap :</label>
                <div class="col-sm-9">
                    <input disabled class="form-control" value="<?php echo htmlspecialchars($detailglukosapuasa['nama_lengkap']); ?>">
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-3 col-form-label">Kadar Glukosa Darah Puasa (mg/dL) :</label>
                <div class="col-sm-9">
                    <input disabled class="form-control" value="<?php echo htmlspecialchars($detailglukosapuasa['kadar_glukosa_puasa']); ?>">
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-3 col-form-label">Tanggal Pengukuran :</label>
                <div class="col-sm-9">
                    <input disabled class="form-control" value="<?php echo htmlspecialchars($detailglukosapuasa['tanggal_pengukuran']); ?>">
                </div>
            </div>

        </div>

        <div class="card-footer">
            <div class="row">
                <div class="col-md-11">
                    <a href="index.php?halaman=edit_glukosa_puasa&id_glukosa_puasa=<?php echo $detailglukosapuasa['id_glukosa_puasa']; ?>" class="btn btn-warning">Edit Data</a>
                </div>
                <div class="col-md-1 text-right">
                    <a href="index.php?halaman=glukosa_puasa" class="btn btn-danger">Kembali</a>
                </div>
            </div>
        </div>
    </div>

</div>

</body>
</html>
