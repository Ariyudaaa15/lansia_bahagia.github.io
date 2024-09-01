<div class="shadow p-3 bg-white rounded">
    <h5><b>Selamat Datang Di Halaman Edit Data Lansia</b></h5>
</div>

<?php 

include '../koneksi/konek.php';

$id_lansia = $_GET['id_lansia'];

// Data Lansia
$ambil = mysqli_query($koneksi, "SELECT * FROM lansia WHERE id_lansia='$id_lansia'");
$edit = $ambil->fetch_assoc();
?>

<form action="#" method="POST">
    <div class="card shadow bg-white">
        <div class="card-body">

            <div class="form-group row">
                <label class="col-sm-3 col-form-label">Nama Lengkap :</label>
                <div class="col-sm-9">
                    <input type="text" name="nama_lengkap" class="form-control" value="<?php echo htmlspecialchars($edit['nama_lengkap']); ?>" required>
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-3 col-form-label">Umur :</label>
                <div class="col-sm-9">
                    <input type="number" name="umur" class="form-control" value="<?php echo htmlspecialchars($edit['umur']); ?>" required>
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-3 col-form-label">Jenis Kelamin :</label>
                <div class="col-sm-9">
                    <select name="jenis_kelamin" class="form-control" required>
                       
                        <option value="Laki - Laki" <?php echo ($edit['jenis_kelamin'] == 'Laki-Laki') ? 'selected' : ''; ?>>Laki-laki</option>
                        <option value="Perempuan" <?php echo ($edit['jenis_kelamin'] == 'Perempuan') ? 'selected' : ''; ?>>Perempuan</option>
                    </select>
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-3 col-form-label">Alamat :</label>
                <div class="col-sm-9">
                    <input type="text" name="alamat" class="form-control" value="<?php echo htmlspecialchars($edit['alamat']); ?>" required>
                </div>
            </div>

        </div>

        <div class="card-footer">
            <div class="row">
                <div class="col-md-11">
                    <button name="simpan" class="btn btn-success">Simpan</button>
                </div>
                <div class="col-md-1 text-right">
                    <a href="index.php?halaman=lansia" class="btn btn-danger">Kembali</a>
                </div>
            </div>
        </div>
    </div>
</form>

<?php 
if (isset($_POST['simpan'])) {
    $nama_lengkap = $_POST['nama_lengkap'];
    $umur = $_POST['umur'];
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $alamat = $_POST['alamat'];

    // Update Data
    $lansiaUpdate = mysqli_query($koneksi, "UPDATE lansia SET nama_lengkap='$nama_lengkap', umur='$umur', jenis_kelamin='$jenis_kelamin', alamat='$alamat' WHERE id_lansia='$id_lansia'");

    if ($lansiaUpdate) {
        echo "<script src='../assets/dist/sweetalert2.all.min.js'></script>";
        echo "<script>
            Swal.fire({
                title: 'Data Berhasil Diedit',
                text: 'Data lansia telah berhasil diperbarui!',
                icon: 'success'
            }).then(() => {
                window.location.href = 'index.php?halaman=lansia';
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
