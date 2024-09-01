<?php 
include '../koneksi/konek.php'; // Ganti dengan path yang sesuai untuk koneksi database

// Ambil data kolesterol dari database
$kolesterol_total = array();
$ambil = $koneksi->query("SELECT kt.id_kolesterol, l.nama_lengkap, kt.kadar_kolesterol, kt.tanggal_pengukuran
                          FROM kolesterol_total kt
                          JOIN lansia l ON kt.id_lansia = l.id_lansia");
while($pecah = $ambil->fetch_assoc()) {
    $kolesterol_total[] = $pecah;
}
?>

<a href="index.php?halaman=tambah_kolestrol_total" class="btn btn-primary mt-3">Tambah Data</a>

<div class="card shadow bg-white mt-3">
    <div class="card-body">
        <table class="table table-bordered table-hover table-striped" id="tables">
            <thead>
                <tr>
                    <th>No</th>
                    <th>ID Kolesterol</th>
                    <th>Nama Lengkap</th>
                    <th>Kadar Kolesterol</th>
                    <th>Tanggal Pengukuran</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach ($kolesterol_total as $key => $value): ?>
                <tr>
                    <td width="50"><?php echo $key + 1; ?></td>
                    <td><?php echo $value['id_kolesterol']; ?></td>
                    <td><?php echo $value['nama_lengkap']; ?></td>
                    <td><?php echo $value['kadar_kolesterol']; ?></td>
                    <td><?php echo $value['tanggal_pengukuran']; ?></td>
                    <td class="text-center" width="200">
                        <a href="index.php?halaman=detail_kolestrol_total&id=<?php echo $value['id_kolesterol']; ?>" class="btn btn-info">Detail</a>
                        <a href="index.php?halaman=hapus_kolestrol_total&id=<?php echo $value['id_kolesterol']; ?>" class="btn btn-danger">Hapus</a>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
