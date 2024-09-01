<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Asam Urat</title>
    <link rel="stylesheet" href="../assets/dist/bootstrap.min.css">
    <script src="../assets/dist/sweetalert2.all.min.js"></script>
</head>
<body>

<div class="container mt-4">
    <div class="shadow p-3 bg-white rounded">
        <h5><b>Selamat Datang di Halaman Detail Asam Urat</b></h5>
    </div>

    <?php 
    include '../koneksi/konek.php'; // Pastikan file koneksi terhubung dengan benar

    // Ambil ID asam urat dari URL dan pastikan nilainya ada
    $id_asam_urat = $_GET['id'] ?? null;

    // Periksa apakah ID valid
    if ($id_asam_urat) {
        // Ambil data detail asam urat berdasarkan ID
        $ambil = mysqli_query($koneksi, "SELECT au.*, l.nama_lengkap 
                                         FROM asam_urat au 
                                         JOIN lansia l ON au.id_lansia = l.id_lansia 
                                         WHERE au.id_asam_urat='$id_asam_urat'");
        // Cek apakah query berhasil
        if ($ambil) {
            $detailAsamUrat = mysqli_fetch_assoc($ambil);

            // Cek apakah data ditemukan
            if (!$detailAsamUrat) {
                echo "<div class='alert alert-danger'>Data asam urat tidak ditemukan.</div>";
                exit;
            }
        } else {
            // Tampilkan pesan jika query gagal
            echo "<div class='alert alert-danger'>Terjadi kesalahan saat mengambil data: " . mysqli_error($koneksi) . "</div>";
            exit;
        }
    } else {
        echo "<div class='alert alert-danger'>ID asam urat tidak valid.</div>";
        exit;
    }
    ?>

    <div class="card shadow bg-white mt-3">
        <div class="card-header">
            <strong>Data Asam Urat</strong>
        </div>
        <div class="card-body">

            <div class="form-group row">
                <label class="col-sm-3 col-form-label">Nama Lengkap :</label>
                <div class="col-sm-9">
                    <input disabled class="form-control" value="<?php echo htmlspecialchars($detailAsamUrat['nama_lengkap']); ?>">
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-3 col-form-label">Kadar Asam Urat (mg/dL) :</label>
                <div class="col-sm-9">
                    <input disabled class="form-control" value="<?php echo htmlspecialchars($detailAsamUrat['kadar_asam_urat']); ?>">
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-3 col-form-label">Tanggal Pengukuran :</label>
                <div class="col-sm-9">
                    <input disabled class="form-control" value="<?php echo htmlspecialchars($detailAsamUrat['tanggal_pengukuran']); ?>">
                </div>
            </div>

        </div>

        <div class="card-footer">
            <div class="row">
                <div class="col-md-11">
                    <a href="index.php?halaman=edit_asam_urat&id_asam_urat=<?php echo $detailAsamUrat['id_asam_urat']; ?>" class="btn btn-warning">Edit Data</a>
                </div>
                <div class="col-md-1 text-right">
                    <a href="index.php?halaman=asam_urat" class="btn btn-danger">Kembali</a>
                </div>
            </div>
        </div>
    </div>

</div>

</body>
</html>
