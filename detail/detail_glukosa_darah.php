<div class="shadow p-3 bg-white rounded">
    <h5><b>Selamat Datang Di Halaman Detail Glukosa Darah</b></h5>
</div>

<?php 
include '../koneksi/konek.php';

// Ambil ID glukosa dari URL dan pastikan nilainya ada
$id_glukosa_darah = $_GET['id'] ?? null;

// Periksa apakah ID valid
if ($id_glukosa_darah) {
    // Ambil data detail glukosa darah berdasarkan ID
    $ambil = mysqli_query($koneksi, "SELECT g.*, l.nama_lengkap 
                                     FROM kadar_glukosa_darah g 
                                     JOIN lansia l ON g.id_lansia = l.id_lansia 
                                     WHERE g.id_glukosa_darah='$id_glukosa_darah'");
    // Cek apakah query berhasil
    if ($ambil) {
        $detailglukosa = mysqli_fetch_assoc($ambil);

        // Cek apakah data ditemukan
        if (!$detailglukosa) {
            echo "<div class='alert alert-danger'>Data glukosa tidak ditemukan.</div>";
            exit;
        }
    } else {
        // Tampilkan pesan jika query gagal
        echo "<div class='alert alert-danger'>Terjadi kesalahan saat mengambil data: " . mysqli_error($koneksi) . "</div>";
        exit;
    }
} else {
    echo "<div class='alert alert-danger'>ID glukosa tidak valid.</div>";
    exit;
}
?>

<div class="card shadow bg-white mt-3">
    <div class="card-header">
        <strong>Data Glukosa Darah</strong>
    </div>
    <div class="card-body">

        <div class="form-group row">
            <label class="col-sm-3 col-form-label">Nama Lengkap :</label>
            <div class="col-sm-9">
                <input disabled class="form-control" value="<?php echo htmlspecialchars($detailglukosa['nama_lengkap']); ?>">
            </div>
        </div>

        <div class="form-group row">
            <label class="col-sm-3 col-form-label">Kadar Glukosa Darah (mg/dL) :</label>
            <div class="col-sm-9">
                <input disabled class="form-control" value="<?php echo htmlspecialchars($detailglukosa['kadar_glukosa']); ?>">
            </div>
        </div>

        <div class="form-group row">
            <label class="col-sm-3 col-form-label">Tanggal Pengukuran :</label>
            <div class="col-sm-9">
                <input disabled class="form-control" value="<?php echo htmlspecialchars($detailglukosa['tanggal_pengukuran']); ?>">
            </div>
        </div>

    </div>

    <div class="card-footer">
        <div class="row">
            <div class="col-md-11">
                <a href="index.php?halaman=edit_glukosa_darah&id_glukosa_darah=<?php echo $detailglukosa['id_glukosa_darah']; ?>" class="btn btn-warning">Edit Data</a>
            </div>
            <div class="col-md-1 text-right">
                <a href="index.php?halaman=glukosa_darah" class="btn btn-danger">Kembali</a>
            </div>
        </div>
    </div>
</div>
