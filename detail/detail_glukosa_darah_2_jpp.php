<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Glukosa Darah 2 JPP</title>
    <link rel="stylesheet" href="../assets/dist/bootstrap.min.css">
    <script src="../assets/dist/sweetalert2.all.min.js"></script>
</head>
<body>

<div class="container mt-4">
    <div class="shadow p-3 bg-white rounded">
        <h5><b>Selamat Datang di Halaman Detail Glukosa Darah 2 JPP</b></h5>
    </div>

    <?php 
    include '../koneksi/konek.php'; // Pastikan file koneksi terhubung dengan benar

    // Ambil ID glukosa darah 2 JPP dari URL dan pastikan nilainya ada
    $id_glukosa = $_GET['id'] ?? null;

    // Periksa apakah ID valid
    if ($id_glukosa) {
        // Ambil data detail glukosa darah 2 JPP berdasarkan ID
        $ambil = mysqli_query($koneksi, "SELECT gd.*, l.nama_lengkap 
                                         FROM glukosa_2_jpp gd 
                                         JOIN lansia l ON gd.id_lansia = l.id_lansia 
                                         WHERE gd.id_glukosa='$id_glukosa'");
        // Cek apakah query berhasil
        if ($ambil) {
            $detailglukosa2jpp = mysqli_fetch_assoc($ambil);

            // Cek apakah data ditemukan
            if (!$detailglukosa2jpp) {
                echo "<div class='alert alert-danger'>Data glukosa darah 2 JPP tidak ditemukan.</div>";
                exit;
            }
        } else {
            // Tampilkan pesan jika query gagal
            echo "<div class='alert alert-danger'>Terjadi kesalahan saat mengambil data: " . mysqli_error($koneksi) . "</div>";
            exit;
        }
    } else {
        echo "<div class='alert alert-danger'>ID glukosa darah 2 JPP tidak valid.</div>";
        exit;
    }
    ?>

    <div class="card shadow bg-white mt-3">
        <div class="card-header">
            <strong>Data Glukosa Darah 2 JPP</strong>
        </div>
        <div class="card-body">

            <div class="form-group row">
                <label class="col-sm-3 col-form-label">Nama Lengkap :</label>
                <div class="col-sm-9">
                    <input disabled class="form-control" value="<?php echo htmlspecialchars($detailglukosa2jpp['nama_lengkap']); ?>">
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-3 col-form-label">Kadar Glukosa Darah 2 JPP (mg/dL) :</label>
                <div class="col-sm-9">
                    <input disabled class="form-control" value="<?php echo htmlspecialchars($detailglukosa2jpp['kadar_glukosa']); ?>">
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-3 col-form-label">Tanggal Pengukuran :</label>
                <div class="col-sm-9">
                    <input disabled class="form-control" value="<?php echo htmlspecialchars($detailglukosa2jpp['tanggal_pengukuran']); ?>">
                </div>
            </div>

        </div>

        <div class="card-footer">
            <div class="row">
                <div class="col-md-11">
                    <a href="index.php?halaman=edit_glukosa_darah_2_jpp&id_glukosa=<?php echo $detailglukosa2jpp['id_glukosa']; ?>" class="btn btn-warning">Edit Data</a>
                </div>
                <div class="col-md-1 text-right">
                    <a href="index.php?halaman=glukosa_darah_2jpp" class="btn btn-danger">Kembali</a>
                </div>
            </div>
        </div>
    </div>

</div>

</body>
</html>
