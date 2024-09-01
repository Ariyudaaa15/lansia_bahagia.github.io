<div class="shadow p-3 bg-white rounded">
    <h5><b>Selamat Datang Di Halaman Edit Data Glukosa Darah</b></h5>
</div>

<?php 
include '../koneksi/konek.php';

// Ambil ID glukosa darah dari URL
$id_glukosa_darah = $_GET['id_glukosa_darah'];

// Ambil data glukosa darah berdasarkan ID
$ambil = mysqli_query($koneksi, "SELECT * FROM kadar_glukosa_darah WHERE id_glukosa_darah='$id_glukosa_darah'");
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
                <label class="col-sm-3 col-form-label">Kadar Glukosa Darah (mg/dL) :</label>
                <div class="col-sm-9">
                    <input type="number" name="kadar_glukosa" class="form-control" value="<?php echo htmlspecialchars($edit['kadar_glukosa']); ?>" required>
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-3 col-form-label">Tangga Pengukuran :</label>
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
                    <a href="index.php?halaman=glukosa_darah" class="btn btn-danger">Kembali</a>
                </div>
            </div>
        </div>
    </div>
</form>

<?php 
if (isset($_POST['simpan'])) {
    $kadar_glukosa = $_POST['kadar_glukosa'];
    $tanggal_pengukuran = $_POST['tanggal_pengukuran'];

    // Update data glukosa darah
    $glukosaUpdate = mysqli_query($koneksi, "UPDATE kadar_glukosa_darah SET kadar_glukosa='$kadar_glukosa', tanggal_pengukuran='$tanggal_pengukuran' WHERE id_glukosa_darah='$id_glukosa_darah'");

    if ($glukosaUpdate) {
        echo "<script src='../assets/dist/sweetalert2.all.min.js'></script>";
        echo "<script>
            Swal.fire({
                title: 'Data Berhasil Diedit',
                text: 'Data glukosa darah telah berhasil diperbarui!',
                icon: 'success'
            }).then(() => {
                window.location.href = 'index.php?halaman=glukosa_darah';
            });
        </script>";
    } else {
        echo "<script src='../assets/dist/sweetalert2.all.min.js'></script>";
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
