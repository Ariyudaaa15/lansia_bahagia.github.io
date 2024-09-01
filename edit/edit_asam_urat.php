<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data Asam Urat</title>
    <link rel="stylesheet" href="../assets/dist/bootstrap.min.css">
    <script src="../assets/dist/sweetalert2.all.min.js"></script>
</head>
<body>

<div class="container mt-4">
    <div class="shadow p-3 bg-white rounded">
        <h5><b>Selamat Datang Di Halaman Edit Data Asam Urat</b></h5>
    </div>

    <?php 
    include '../koneksi/konek.php';

    // Ambil ID asam urat dari URL
    $id_asam_urat = $_GET['id_asam_urat'];

    // Ambil data asam urat berdasarkan ID
    $ambil = mysqli_query($koneksi, "SELECT au.*, l.nama_lengkap FROM asam_urat au 
                                      JOIN lansia l ON au.id_lansia = l.id_lansia 
                                      WHERE au.id_asam_urat='$id_asam_urat'");
    $edit = mysqli_fetch_assoc($ambil);
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
                    <label class="col-sm-3 col-form-label">Kadar Asam Urat (mg/dL) :</label>
                    <div class="col-sm-9">
                        <input type="number" name="kadar_asam_urat" class="form-control" value="<?php echo htmlspecialchars($edit['kadar_asam_urat']); ?>" required>
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
                        <a href="index.php?halaman=asam_urat" class="btn btn-danger">Kembali</a>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <?php 
    if (isset($_POST['simpan'])) {
        $kadar_asam_urat = $_POST['kadar_asam_urat'];
        $tanggal_pengukuran = $_POST['tanggal_pengukuran'];

        // Update data asam urat
        $asamUratUpdate = mysqli_query($koneksi, "UPDATE asam_urat 
                                                  SET kadar_asam_urat='$kadar_asam_urat', tanggal_pengukuran='$tanggal_pengukuran' 
                                                  WHERE id_asam_urat='$id_asam_urat'");

        if ($asamUratUpdate) {
            echo "<script>
                Swal.fire({
                    title: 'Data Berhasil Diedit',
                    text: 'Data asam urat telah berhasil diperbarui!',
                    icon: 'success'
                }).then(() => {
                    window.location.href = 'index.php?halaman=asam_urat';
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
