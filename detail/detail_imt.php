<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Indeks Massa Tubuh (IMT)</title>
    <link rel="stylesheet" href="../assets/dist/bootstrap.min.css">
    <script src="../assets/dist/sweetalert2.all.min.js"></script>
</head>
<body>

<div class="container mt-4">
    <div class="shadow p-3 bg-white rounded">
        <h5><b>Selamat Datang di Halaman Detail Indeks Massa Tubuh (IMT)</b></h5>
    </div>

    <?php 
    include '../koneksi/konek.php'; // Pastikan file koneksi terhubung dengan benar

    // Ambil ID IMT dari URL dan pastikan nilainya ada
    $id_imt = $_GET['id'] ?? null;

    // Periksa apakah ID valid
    if ($id_imt) {
        // Ambil data detail IMT berdasarkan ID
        $ambil = mysqli_query($koneksi, "SELECT imt.*, l.nama_lengkap 
                                         FROM imt 
                                         JOIN lansia l ON imt.id_lansia = l.id_lansia 
                                         WHERE imt.id_imt='$id_imt'");
        // Cek apakah query berhasil
        if ($ambil) {
            $detailIMT = mysqli_fetch_assoc($ambil);

            // Cek apakah data ditemukan
            if (!$detailIMT) {
                echo "<div class='alert alert-danger'>Data IMT tidak ditemukan.</div>";
                exit;
            }
        } else {
            // Tampilkan pesan jika query gagal
            echo "<div class='alert alert-danger'>Terjadi kesalahan saat mengambil data: " . mysqli_error($koneksi) . "</div>";
            exit;
        }
    } else {
        echo "<div class='alert alert-danger'>ID IMT tidak valid.</div>";
        exit;
    }
    ?>

    <div class="card shadow bg-white mt-3">
        <div class="card-header">
            <strong>Data Indeks Massa Tubuh (IMT)</strong>
        </div>
        <div class="card-body">

            <div class="form-group row">
                <label class="col-sm-3 col-form-label">Nama Lengkap :</label>
                <div class="col-sm-9">
                    <input disabled class="form-control" value="<?php echo htmlspecialchars($detailIMT['nama_lengkap']); ?>">
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-3 col-form-label">Indeks Massa Tubuh (IMT) :</label>
                <div class="col-sm-9">
                    <input disabled class="form-control" value="<?php echo htmlspecialchars($detailIMT['imt']); ?>">
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-3 col-form-label">Tanggal Pengukuran :</label>
                <div class="col-sm-9">
                    <input disabled class="form-control" value="<?php echo htmlspecialchars($detailIMT['tanggal_pengukuran']); ?>">
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-3 col-form-label">Kategori IMT :</label>
                <div class="col-sm-9">
                    <input disabled class="form-control" value="<?php
                    $imt = $detailIMT['imt'];
                    if ($imt < 18.5) {
                        echo 'Kekurangan Berat Badan';
                    } elseif ($imt >= 18.5 && $imt < 25) {
                        echo 'Berat Badan Normal';
                    } elseif ($imt >= 25 && $imt < 30) {
                        echo 'Kelebihan Berat Badan';
                    } else {
                        echo 'Obesitas';
                    }
                    ?>">
                </div>
            </div>

        </div>

        <div class="card-footer">
            <div class="row">
                <div class="col-md-11">
                    <a href="index.php?halaman=edit_imt&id_imt=<?php echo $detailIMT['id_imt']; ?>" class="btn btn-warning">Edit Data</a>
                </div>
                <div class="col-md-1 text-right">
                    <a href="index.php?halaman=imt" class="btn btn-danger">Kembali</a>
                </div>
            </div>
        </div>
    </div>

</div>

</body>
</html>
