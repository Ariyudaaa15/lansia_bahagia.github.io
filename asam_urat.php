<?php 
include '../koneksi/konek.php';

// Ambil data asam urat dari database
$asam_urat = array();
$ambil = $koneksi->query("SELECT au.id_asam_urat, l.nama_lengkap, au.kadar_asam_urat, au.tanggal_pengukuran
                          FROM asam_urat au
                          JOIN lansia l ON au.id_lansia = l.id_lansia");
while($pecah = $ambil->fetch_assoc()) {
    $asam_urat[] = $pecah;
}
?>

<a href="index.php?halaman=tambah_asam_urat" class="btn btn-primary mt-3">Tambah Data</a>

<div class="card shadow bg-white mt-3">
    <div class="card-body">
        <table class="table table-bordered table-hover table-striped" id="tables">
            <thead>
                <tr>
                    <th>No</th>
                    <th>ID Asam Urat</th>
                    <th>Nama Lengkap</th>
                    <th>Kadar Asam Urat</th>
                    <th>Tanggal Pengukuran</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach ($asam_urat as $key => $value): ?>
                <tr>
                    <td width="50"><?php echo $key + 1; ?></td>
                    <td><?php echo $value['id_asam_urat']; ?></td>
                    <td><?php echo $value['nama_lengkap']; ?></td>
                    <td><?php echo $value['kadar_asam_urat']; ?></td>
                    <td><?php echo $value['tanggal_pengukuran']; ?></td>
                    <td class="text-center" width="200">
                        <a href="index.php?halaman=detail_asam_urat&id=<?php echo $value['id_asam_urat']; ?>" class="btn btn-info">Detail</a>
                        <a href="index.php?halaman=hapus_asam_urat&id=<?php echo $value['id_asam_urat']; ?>" class="btn btn-danger">Hapus</a>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
