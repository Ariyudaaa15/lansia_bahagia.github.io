<?php 
include '../koneksi/konek.php';

// Ambil data SpO2 dari database
$sp02_data = array();
$ambil = $koneksi->query("SELECT sp.id_sp02, l.nama_lengkap, sp.kadar_sp02, sp.tanggal_pengukuran
                          FROM sp02 sp
                          JOIN lansia l ON sp.id_lansia = l.id_lansia");
while($pecah = $ambil->fetch_assoc()) {
    $sp02_data[] = $pecah;
}
?>

<a href="index.php?halaman=tambah_sp02" class="btn btn-primary mt-3">Tambah Data</a>

<div class="card shadow bg-white mt-3">
    <div class="card-body">
        <table class="table table-bordered table-hover table-striped" id="tables">
            <thead>
                <tr>
                    <th>No</th>
                    <th>ID SpO2</th>
                    <th>Nama Lengkap</th>
                    <th>Kadar SpO2 (%)</th>
                    <th>Tanggal Pengukuran</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach ($sp02_data as $key => $value): ?>
                <tr>
                    <td width="50"><?php echo $key + 1; ?></td>
                    <td><?php echo $value['id_sp02']; ?></td>
                    <td><?php echo $value['nama_lengkap']; ?></td>
                    <td><?php echo $value['kadar_sp02']; ?></td>
                    <td><?php echo $value['tanggal_pengukuran']; ?></td>
                    <td class="text-center" width="200">
                        <a href="index.php?halaman=detail_sp02&id=<?php echo $value['id_sp02']; ?>" class="btn btn-info">Detail</a>
                        <a href="index.php?halaman=hapus_sp02&id=<?php echo $value['id_sp02']; ?>" class="btn btn-danger">Hapus</a>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
