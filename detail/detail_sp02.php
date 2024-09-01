<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Saturasi Oksigen (SpO2)</title>
    <link rel="stylesheet" href="../assets/dist/bootstrap.min.css">
    <script src="../assets/dist/sweetalert2.all.min.js"></script>
</head>
<body>

<div class="container mt-4">
    <div class="shadow p-3 bg-white rounded">
        <h5><b>Selamat Datang di Halaman Detail Saturasi Oksigen (SpO2)</b></h5>
    </div>

    <?php 
    include '../koneksi/konek.php'; // Pastikan file koneksi terhubung dengan benar

    // Ambil ID Saturasi Oksigen dari URL dan pastikan nilainya ada
    $id_sp02 = $_GET['id'] ?? null;

    // Periksa apakah ID valid
    if ($id_sp02) {
        // Ambil data detail Saturasi Oksigen berdasarkan ID
        $ambil = mysqli_query($koneksi, "SELECT s.*, l.nama_lengkap 
                                         FROM sp02 s 
                                         JOIN lansia l ON s.id_lansia = l.id_lansia 
                                         WHERE s.id_sp02='$id_sp02'");
        // Cek apakah query berhasil
        if ($ambil) {
            $detailSpO2 = mysqli_fetch_assoc($ambil);

            // Cek apakah data ditemukan
            if (!$detailSpO2) {
                echo "<div class='alert alert-danger'>Data Saturasi Oksigen (SpO2) tidak ditemukan.</div>";
                exit;
            }
        } else {
            // Tampilkan pesan jika query gagal
            echo "<div class='alert alert-danger'>Terjadi kesalahan saat mengambil data: " . mysqli_error($koneksi) . "</div>";
            exit;
        }
    } else {
        echo "<div class='alert alert-danger'>ID Saturasi Oksigen (SpO2) tidak valid.</div>";
        exit;
    }
    ?>

    <div class="card shadow bg-white mt-3">
        <div class="card-header">
            <strong>Data Saturasi Oksigen (SpO2)</strong>
        </div>
        <div class="card-body">

            <div class="form-group row">
                <label class="col-sm-3 col-form-label">Nama Lengkap :</label>
                <div class="col-sm-9">
                    <input disabled class="form-control" value="<?php echo htmlspecialchars($detailSpO2['nama_lengkap']); ?>">
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-3 col-form-label">Saturasi Oksigen (SpO2) (%) :</label>
                <div class="col-sm-9">
                    <input disabled class="form-control" value="<?php echo htmlspecialchars($detailSpO2['kadar_sp02']); ?>">
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-3 col-form-label">Tanggal Pengukuran :</label>
                <div class="col-sm-9">
                    <input disabled class="form-control" value="<?php echo htmlspecialchars($detailSpO2['tanggal_pengukuran']); ?>">
                </div>
            </div>

        </div>

        <div class="card-footer">
            <div class="row">
                <div class="col-md-11">
                    <a href="index.php?halaman=edit_sp02&id_sp02=<?php echo $detailSpO2['id_sp02']; ?>" class="btn btn-warning">Edit Data</a>
                </div>
                <div class="col-md-1 text-right">
                    <a href="index.php?halaman=sp02" class="btn btn-danger">Kembali</a>
                </div>
            </div>
        </div>
    </div>

</div>

</body>
</html>
