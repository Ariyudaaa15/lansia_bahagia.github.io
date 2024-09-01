<?php 
include '../koneksi/konek.php';

// Ambil data glukosa darah dari database
$glukosa_darah = array();
$ambil = $koneksi->query("SELECT gd.id_glukosa_darah, l.nama_lengkap, gd.kadar_glukosa, gd.tanggal_pengukuran
                          FROM kadar_glukosa_darah gd
                          JOIN lansia l ON gd.id_lansia = l.id_lansia");
while($pecah = $ambil->fetch_assoc()) {
    $glukosa_darah[] = $pecah;
}
?>

<a href="index.php?halaman=tambah_glukosa_darah" class="btn btn-primary mt-3">Tambah Data</a>

<div class="card shadow bg-white mt-3">
    <div class="card-body">
        <table class="table table-bordered table-hover table-striped" id="tables">
            <thead>
                <tr>
                    <th>No</th>
                    <th>ID Glukosa Darah</th>
                    <th>Nama Lengkap</th>
                    <th>Kadar Glukosa</th>
                    <th>Tanggal Pengukuran</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach ($glukosa_darah as $key => $value): ?>
                <tr>
                    <td width="50"><?php echo $key + 1; ?></td>
                    <td><?php echo $value['id_glukosa_darah']; ?></td>
                    <td><?php echo $value['nama_lengkap']; ?></td>
                    <td><?php echo $value['kadar_glukosa']; ?></td>
                    <td><?php echo $value['tanggal_pengukuran']; ?></td>
                    <td class="text-center" width="200">
                        <a href="index.php?halaman=detail_glukosa_darah&id=<?php echo $value['id_glukosa_darah']; ?>" class="btn btn-info">Detail</a>
                        <a href="index.php?halaman=hapus_glukosa_darah&id=<?php echo $value['id_glukosa_darah']; ?>" class="btn btn-danger">Hapus</a>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
