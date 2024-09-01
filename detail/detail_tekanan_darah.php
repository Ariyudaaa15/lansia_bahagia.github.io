<div class="shadow p-3 bg-white rounded">
    <h5><b>Selamat Datang Di Halaman Detail Tekanan Darah</b></h5>
</div>

<?php 
include '../koneksi/konek.php';

// Ambil ID dari parameter URL
$id_tekanan_darah = isset($_GET['id']) ? $_GET['id'] : '';

// Query untuk mengambil data tekanan darah berdasarkan ID
$query = "SELECT * FROM tekanan_darah WHERE id_tekanan_darah='$id_tekanan_darah'";
$ambil = mysqli_query($koneksi, $query);

// Cek apakah query berhasil dan data ditemukan
if ($ambil && mysqli_num_rows($ambil) > 0) {
    $detailTekananDarah = mysqli_fetch_assoc($ambil);
} else {
    echo '<div class="alert alert-danger">Data tekanan darah tidak ditemukan.</div>';
    exit;
}
?>

<div class="card shadow bg-white mt-3">
    <div class="card-header">
        <strong>Data Tekanan Darah</strong>
    </div>
    <div class="card-body">

        <div class="form-group row">
            <label class="col-sm-3 col-form-label">ID Lansia :</label>
            <div class="col-sm-9">
                <input disabled class="form-control" value="<?php echo htmlspecialchars($detailTekananDarah['id_lansia']); ?>">
            </div>
        </div>

        <div class="form-group row">
            <label class="col-sm-3 col-form-label">Nama Lengkap :</label>
            <div class="col-sm-9">
                <input disabled class="form-control" value="<?php echo htmlspecialchars($detailTekananDarah['nama_lengkap']); ?>">
            </div>
        </div>

        <div class="form-group row">
            <label class="col-sm-3 col-form-label">Tekanan Sistolik :</label>
            <div class="col-sm-9">
                <input disabled class="form-control" value="<?php echo htmlspecialchars($detailTekananDarah['tekanan_sistolik']); ?>">
            </div>
        </div>

        <div class="form-group row">
            <label class="col-sm-3 col-form-label">Tekanan Diastolik :</label>
            <div class="col-sm-9">
                <input disabled class="form-control" value="<?php echo htmlspecialchars($detailTekananDarah['tekanan_diastolik']); ?>">
            </div>
        </div>

        <div class="form-group row">
            <label class="col-sm-3 col-form-label">Tanggal Pengukuran :</label>
            <div class="col-sm-9">
                <input disabled class="form-control" value="<?php echo htmlspecialchars($detailTekananDarah['tanggal_pengukuran']); ?>">
            </div>
        </div>

    </div>

    <div class="card-footer">
        <div class="row">
            <div class="col-md-11">
                <a href="index.php?halaman=edit_tekanan_darah&id_tekanan_darah=<?php echo $detailTekananDarah['id_tekanan_darah']; ?>" class="btn btn-warning">Edit Data</a>
            </div>
            <div class="col-md-1 text-right">
                <a href="index.php?halaman=tekanan_darah" class="btn btn-danger">Kembali</a>
            </div>
        </div>
    </div>
</div>
