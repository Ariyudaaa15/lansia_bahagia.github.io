<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Kolesterol Total</title>
    <link rel="stylesheet" href="../assets/dist/bootstrap.min.css">
    <script src="../assets/dist/sweetalert2.all.min.js"></script>
</head>
<body>

<div class="container mt-4">
    <div class="shadow p-3 bg-white rounded">
        <h5><b>Selamat Datang di Halaman Detail Kolesterol Total</b></h5>
    </div>

    <?php 
    include '../koneksi/konek.php'; // Pastikan file koneksi terhubung dengan benar

    // Ambil ID kolesterol dari URL dan pastikan nilainya ada
    $id_kolesterol = $_GET['id'] ?? null;

    // Periksa apakah ID valid
    if ($id_kolesterol) {
        // Ambil data detail kolesterol berdasarkan ID
        $ambil = mysqli_query($koneksi, "SELECT kt.*, l.nama_lengkap 
                                         FROM kolesterol_total kt 
                                         JOIN lansia l ON kt.id_lansia = l.id_lansia 
                                         WHERE kt.id_kolesterol='$id_kolesterol'");
        // Cek apakah query berhasil
        if ($ambil) {
            $detailKolesterolTotal = mysqli_fetch_assoc($ambil);

            // Cek apakah data ditemukan
            if (!$detailKolesterolTotal) {
                echo "<div class='alert alert-danger'>Data kolesterol total tidak ditemukan.</div>";
                exit;
            }
        } else {
            // Tampilkan pesan jika query gagal
            echo "<div class='alert alert-danger'>Terjadi kesalahan saat mengambil data: " . mysqli_error($koneksi) . "</div>";
            exit;
        }
    } else {
        echo "<div class='alert alert-danger'>ID kolesterol total tidak valid.</div>";
        exit;
    }
    ?>

    <div class="card shadow bg-white mt-3">
        <div class="card-header">
            <strong>Data Kolesterol Total</strong>
        </div>
        <div class="card-body">

            <div class="form-group row">
                <label class="col-sm-3 col-form-label">Nama Lengkap :</label>
                <div class="col-sm-9">
                    <input disabled class="form-control" value="<?php echo htmlspecialchars($detailKolesterolTotal['nama_lengkap']); ?>">
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-3 col-form-label">Kadar Kolesterol Total (mg/dL) :</label>
                <div class="col-sm-9">
                    <input disabled class="form-control" value="<?php echo htmlspecialchars($detailKolesterolTotal['kadar_kolesterol']); ?>">
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-3 col-form-label">Tanggal Pengukuran :</label>
                <div class="col-sm-9">
                    <input disabled class="form-control" value="<?php echo htmlspecialchars($detailKolesterolTotal['tanggal_pengukuran']); ?>">
                </div>
            </div>

        </div>

        <div class="card-footer">
            <div class="row">
                <div class="col-md-11">
                    <a href="index.php?halaman=edit_kolestrol_total&id_kolesterol=<?php echo $detailKolesterolTotal['id_kolesterol']; ?>" class="btn btn-warning">Edit Data</a>
                </div>
                <div class="col-md-1 text-right">
                    <a href="index.php?halaman=kolesterol_total" class="btn btn-danger">Kembali</a>
                </div>
            </div>
        </div>
    </div>

</div>

</body>
</html>
