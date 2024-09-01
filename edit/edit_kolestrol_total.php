<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data Kolesterol Total</title>
    <link rel="stylesheet" href="../assets/dist/bootstrap.min.css">
    <script src="../assets/dist/sweetalert2.all.min.js"></script>
</head>
<body>

<div class="container mt-4">
    <div class="shadow p-3 bg-white rounded">
        <h5><b>Selamat Datang Di Halaman Edit Data Kolesterol Total</b></h5>
    </div>

    <?php 
    include '../koneksi/konek.php'; // Ganti dengan path yang sesuai untuk koneksi database

    // Ambil ID kolesterol total dari URL
    $id_kolesterol = $_GET['id_kolesterol'];

    // Ambil data kolesterol total berdasarkan ID
    $ambil = $koneksi->query("SELECT kt.*, l.nama_lengkap FROM kolesterol_total kt 
                              JOIN lansia l ON kt.id_lansia = l.id_lansia 
                              WHERE kt.id_kolesterol='$id_kolesterol'");
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
                    <label class="col-sm-3 col-form-label">Kadar Kolesterol Total (mg/dL) :</label>
                    <div class="col-sm-9">
                        <input type="number" name="kadar_kolesterol" class="form-control" value="<?php echo htmlspecialchars($edit['kadar_kolesterol']); ?>" required>
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
                        <a href="index.php?halaman=kolesterol_total" class="btn btn-danger">Kembali</a>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <?php 
    if (isset($_POST['simpan'])) {
        $kadar_kolesterol = $_POST['kadar_kolesterol'];
        $tanggal_pengukuran = $_POST['tanggal_pengukuran'];

        // Debug: Outputkan data sebelum update
        echo "<pre>";
        echo "Kadar Kolesterol: " . $kadar_kolesterol . "<br>";
        echo "Tanggal Pengukuran: " . $tanggal_pengukuran . "<br>";
        echo "</pre>";

        // Update data kolesterol total
        $kolesterolUpdate = $koneksi->query("UPDATE kolesterol_total 
                                             SET kadar_kolesterol='$kadar_kolesterol', tanggal_pengukuran='$tanggal_pengukuran' 
                                             WHERE id_kolesterol='$id_kolesterol'");

        if ($kolesterolUpdate) {
            echo "<script>
                Swal.fire({
                    title: 'Data Berhasil Diedit',
                    text: 'Data kolesterol total telah berhasil diperbarui!',
                    icon: 'success'
                }).then(() => {
                    window.location.href = 'index.php?halaman=kolesterol_total';
                });
            </script>";
        } else {
            // Debugging output
            echo "<script>
                console.log('Error: " . $koneksi->error . "'); // Output error to console
                Swal.fire({
                    title: 'Gagal Mengedit Data',
                    text: 'Terjadi kesalahan saat memperbarui data.',
                    icon: 'error'
                });
            </script>";
        }
    }
    ?>

</div>

</body>
</html>
