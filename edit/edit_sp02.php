<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data Saturasi Oksigen (SpO2)</title>
    <link rel="stylesheet" href="../assets/dist/bootstrap.min.css">
    <script src="../assets/dist/sweetalert2.all.min.js"></script>
</head>
<body>

<div class="container mt-4">
    <div class="shadow p-3 bg-white rounded">
        <h5><b>Selamat Datang Di Halaman Edit Data Saturasi Oksigen (SpO2)</b></h5>
    </div>

    <?php 
    include '../koneksi/konek.php';

    // Ambil ID SpO2 dari URL
    $id_sp02 = $_GET['id_sp02'] ?? null;

    // Data Saturasi Oksigen
    if ($id_sp02) {
        $ambil = mysqli_query($koneksi, "SELECT * FROM sp02 WHERE id_sp02='$id_sp02'");
        $edit = mysqli_fetch_assoc($ambil);

        // Data Lansia (untuk menampilkan nama lengkap)
        $ambilLansia = mysqli_query($koneksi, "SELECT nama_lengkap FROM lansia WHERE id_lansia = '{$edit['id_lansia']}'");
        $lansia = mysqli_fetch_assoc($ambilLansia);
    }
    ?>

    <form action="#" method="POST">
        <div class="card shadow bg-white">
            <div class="card-body">

                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">ID Lansia :</label>
                    <div class="col-sm-9">
                        <input type="text" name="id_lansia" class="form-control" value="<?php echo htmlspecialchars($edit['id_lansia'] ?? ''); ?>" readonly>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Nama Lansia :</label>
                    <div class="col-sm-9">
                        <input type="text" name="nama_lengkap" class="form-control" value="<?php echo htmlspecialchars($lansia['nama_lengkap'] ?? ''); ?>" readonly>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Saturasi Oksigen (SpO2) (%) :</label>
                    <div class="col-sm-9">
                        <input type="number" name="kadar_sp02" class="form-control" value="<?php echo htmlspecialchars($edit['kadar_sp02'] ?? ''); ?>">
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Tanggal Pengukuran :</label>
                    <div class="col-sm-9">
                        <input type="date" name="tanggal_pengukuran" class="form-control" value="<?php echo htmlspecialchars($edit['tanggal_pengukuran'] ?? ''); ?>">
                    </div>
                </div>

            </div>

            <div class="card-footer">
                <div class="row">
                    <div class="col-md-11">
                        <button name="simpan" class="btn btn-success">Simpan</button>
                    </div>
                    <div class="col-md-1 text-right">
                        <a href="index.php?halaman=sp02" class="btn btn-danger">Kembali</a>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <?php 
    if (isset($_POST['simpan'])) {
        $id_lansia = $_POST['id_lansia'];
        $kadar_sp02 = $_POST['kadar_sp02'];
        $tanggal_pengukuran = $_POST['tanggal_pengukuran'];

        // Update Data Saturasi Oksigen
        $updateSpO2 = mysqli_query($koneksi, "UPDATE sp02 SET id_lansia='$id_lansia', kadar_sp02='$kadar_sp02', tanggal_pengukuran='$tanggal_pengukuran' WHERE id_sp02='$id_sp02'");

        if ($updateSpO2) {
            echo "<script>
                Swal.fire({
                    title: 'Data Berhasil Diedit',
                    text: 'Data saturasi oksigen telah berhasil diperbarui!',
                    icon: 'success'
                }).then(() => {
                    window.location.href = 'index.php?halaman=sp02';
                });
            </script>";
        } else {
            echo "<script>
                Swal.fire({
                    title: 'Gagal Mengedit Data',
                    text: 'Terjadi kesalahan saat memperbarui data: " . mysqli_error($koneksi) . "',
                    icon: 'error'
                });
            </script>";
        }
    }
    ?>

</div>

</body>
</html>
