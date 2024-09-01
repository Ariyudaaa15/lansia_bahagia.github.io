<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data Glukosa Darah Acak</title>
    <link rel="stylesheet" href="../assets/dist/bootstrap.min.css">
    <script src="../assets/dist/sweetalert2.all.min.js"></script>
</head>
<body>

<div class="container mt-4">
    <div class="shadow p-3 bg-white rounded">
        <h5><b>Selamat Datang Di Halaman Edit Data Glukosa Darah Acak</b></h5>
    </div>

    <?php 
    include '../koneksi/konek.php';

    // Ambil ID glukosa darah acak dari URL
    $id_glukosa_darah_acak = $_GET['id_glukosa_darah_acak'];

    // Ambil data glukosa darah acak berdasarkan ID
    $ambil = mysqli_query($koneksi, "SELECT ga.*, l.nama_lengkap FROM glukosa_darah_acak ga 
                                      JOIN lansia l ON ga.id_lansia = l.id_lansia 
                                      WHERE ga.id_glukosa_darah_acak='$id_glukosa_darah_acak'");
    $edit = $ambil->fetch_assoc();
    ?>

    <form action="#" method="POST">
        <div class="card shadow bg-white">
            <div class="card-body">

                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Nama Lengkap :</label>
                    <div class="col-sm-9">
                        <input type="text" name="nama_lengkap" class="form-control" value="<?php echo htmlspecialchars($edit['nama_lengkap']); ?>" disabled>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Kadar Glukosa Darah Acak (mg/dL) :</label>
                    <div class="col-sm-9">
                        <input type="number" name="kadar_glukosa" class="form-control" value="<?php echo htmlspecialchars($edit['kadar_glukosa']); ?>" required>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Tanggal Pengukuran :</label>
                    <div class="col-sm-9">
                        <input type="datetime-local" name="tanggal_pengukuran" class="form-control" value="<?php echo htmlspecialchars(date('Y-m-d\TH:i', strtotime($edit['tanggal_pengukuran']))); ?>" required>
                    </div>
                </div>

            </div>

            <div class="card-footer">
                <div class="row">
                    <div class="col-md-11">
                        <button name="simpan" class="btn btn-success">Simpan</button>
                    </div>
                    <div class="col-md-1 text-right">
                        <a href="index.php?halaman=glukosa_darah_acak" class="btn btn-danger">Kembali</a>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <?php 
    if (isset($_POST['simpan'])) {
        $kadar_glukosa = $_POST['kadar_glukosa'];
        $tanggal_pengukuran = $_POST['tanggal_pengukuran'];

        // Update data glukosa darah acak
        $glukosaUpdate = mysqli_query($koneksi, "UPDATE glukosa_darah_acak 
                                                 SET kadar_glukosa='$kadar_glukosa', tanggal_pengukuran='$tanggal_pengukuran' 
                                                 WHERE id_glukosa_darah_acak='$id_glukosa_darah_acak'");

        if ($glukosaUpdate) {
            echo "<script>
                Swal.fire({
                    title: 'Data Berhasil Diedit',
                    text: 'Data glukosa darah acak telah berhasil diperbarui!',
                    icon: 'success'
                }).then(() => {
                    window.location.href = 'index.php?halaman=glukosa_darah_acak';
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
