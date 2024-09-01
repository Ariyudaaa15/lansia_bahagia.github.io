<div class="shadow p-3 bg-white rounded">
    <h5><b>Selamat Datang Di Halaman Edit Data Tekanan Darah</b></h5>
</div>

<?php 

include '../koneksi/konek.php';

$id_tekanan_darah = $_GET['id_tekanan_darah'];

// Data Tekanan Darah
$ambil = mysqli_query($koneksi, "SELECT * FROM tekanan_darah WHERE id_tekanan_darah='$id_tekanan_darah'");
$edit = $ambil->fetch_assoc();

// Data Lansia (untuk menampilkan nama lengkap)
$ambilLansia = mysqli_query($koneksi, "SELECT nama_lengkap FROM lansia WHERE id_lansia = '{$edit['id_lansia']}'");
$lansia = $ambilLansia->fetch_assoc();
?>

<form action="#" method="POST">
    <div class="card shadow bg-white">
        <div class="card-body">

            <div class="form-group row">
                <label class="col-sm-3 col-form-label">ID Lansia :</label>
                <div class="col-sm-9">
                    <input type="text" name="id_lansia" class="form-control" value="<?php echo htmlspecialchars($edit['id_lansia']); ?>" readonly>
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-3 col-form-label">Nama Lansia :</label>
                <div class="col-sm-9">
                    <input type="text" name="nama_lengkap" class="form-control" value="<?php echo htmlspecialchars($lansia['nama_lengkap']); ?>" readonly>
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-3 col-form-label">Tekanan Sistolik :</label>
                <div class="col-sm-9">
                    <input type="number" name="tekanan_sistolik" class="form-control" value="<?php echo htmlspecialchars($edit['tekanan_sistolik']); ?>">
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-3 col-form-label">Tekanan Diastolik :</label>
                <div class="col-sm-9">
                    <input type="number" name="tekanan_diastolik" class="form-control" value="<?php echo htmlspecialchars($edit['tekanan_diastolik']); ?>">
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-3 col-form-label">Tanggal Pengukuran :</label>
                <div class="col-sm-9">
                    <input type="date" name="tanggal_pengukuran" class="form-control" value="<?php echo htmlspecialchars($edit['tanggal_pengukuran']); ?>">
                </div>
            </div>

        </div>

        <div class="card-footer">
            <div class="row">
                <div class="col-md-11">
                    <button name="simpan" class="btn btn-success">Simpan</button>
                </div>
                <div class="col-md-1 text-right">
                    <a href="index.php?halaman=tekanan_darah" class="btn btn-danger">Kembali</a>
                </div>
            </div>
        </div>
    </div>
</form>

<?php 
if (isset($_POST['simpan'])) {
    $id_lansia = $_POST['id_lansia'];
    $tekanan_sistolik = $_POST['tekanan_sistolik'];
    $tekanan_diastolik = $_POST['tekanan_diastolik'];
    $tanggal_pengukuran = $_POST['tanggal_pengukuran'];

    // Update Data Tekanan Darah
    $updateTekananDarah = mysqli_query($koneksi, "UPDATE tekanan_darah SET id_lansia='$id_lansia', tekanan_sistolik='$tekanan_sistolik', tekanan_diastolik='$tekanan_diastolik', tanggal_pengukuran='$tanggal_pengukuran' WHERE id_tekanan_darah='$id_tekanan_darah'");

    if ($updateTekananDarah) {
        echo "<script src='../assets/dist/sweetalert2.all.min.js'></script>";
        echo "<script>
            Swal.fire({
                title: 'Data Berhasil Diedit',
                text: 'Data tekanan darah telah berhasil diperbarui!',
                icon: 'success'
            }).then(() => {
                window.location.href = 'index.php?halaman=tekanan_darah';
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
