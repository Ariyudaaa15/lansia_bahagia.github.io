<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data Indeks Massa Tubuh (IMT)</title>
    <link rel="stylesheet" href="../assets/dist/bootstrap.min.css">
    <script src="../assets/dist/sweetalert2.all.min.js"></script>
</head>
<body>

<div class="container mt-4">
    <div class="shadow p-3 bg-white rounded">
        <h5><b>Selamat Datang Di Halaman Edit Data Indeks Massa Tubuh (IMT)</b></h5>
    </div>

    <?php 
    include '../koneksi/konek.php';

    // Ambil ID IMT dari URL
    $id_imt = $_GET['id_imt'];

    // Ambil data IMT berdasarkan ID
    $ambil = mysqli_query($koneksi, "SELECT imt.*, l.nama_lengkap FROM imt 
                                      JOIN lansia l ON imt.id_lansia = l.id_lansia 
                                      WHERE imt.id_imt='$id_imt'");
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
                    <label class="col-sm-3 col-form-label">Indeks Massa Tubuh (IMT) :</label>
                    <div class="col-sm-9">
                        <input type="number" name="imt" class="form-control" value="<?php echo htmlspecialchars($edit['imt']); ?>" step="0.01" required>
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
                        <a href="index.php?halaman=imt" class="btn btn-danger">Kembali</a>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <?php 
    if (isset($_POST['simpan'])) {
        $imt = $_POST['imt'];
        $tanggal_pengukuran = $_POST['tanggal_pengukuran'];

        // Update data IMT
        $imtUpdate = mysqli_query($koneksi, "UPDATE imt 
                                             SET imt='$imt', tanggal_pengukuran='$tanggal_pengukuran' 
                                             WHERE id_imt='$id_imt'");

        if ($imtUpdate) {
            echo "<script>
                Swal.fire({
                    title: 'Data Berhasil Diedit',
                    text: 'Data IMT telah berhasil diperbarui!',
                    icon: 'success'
                }).then(() => {
                    window.location.href = 'index.php?halaman=imt';
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
