<?php 
include '../koneksi/konek.php';

// Ambil data tekanan darah dari database
$tekanan_darah = array();
$ambil = $koneksi->query("SELECT td.id_tekanan_darah, l.nama_lengkap, td.tekanan_sistolik, td.tekanan_diastolik, td.tanggal_pengukuran
                          FROM tekanan_darah td
                          JOIN lansia l ON td.id_lansia = l.id_lansia");
while($pecah = $ambil->fetch_assoc()) {
    $tekanan_darah[] = $pecah;
}
?>

<a href="index.php?halaman=tambah_tekanan_darah" class="btn btn-primary mt-3">Tambah Data</a>

<div class="card shadow bg-white mt-3">
    <div class="card-body">
        <table class="table table-bordered table-hover table-striped" id="tables">
            <thead>
                <tr>
                    <th>No</th>
                    <th>ID Tekanan Darah</th>
                    <th>Nama Lengkap</th>
                    <th>Tekanan Sistolik</th>
                    <th>Tekanan Diastolik</th>
                    <th>Tanggal Pengukuran</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach ($tekanan_darah as $key => $value): ?>
                <tr>
                    <td width="50"><?php echo $key + 1; ?></td>
                    <td><?php echo $value['id_tekanan_darah']; ?></td>
                    <td><?php echo $value['nama_lengkap']; ?></td>
                    <td><?php echo $value['tekanan_sistolik']; ?></td>
                    <td><?php echo $value['tekanan_diastolik']; ?></td>
                    <td><?php echo $value['tanggal_pengukuran']; ?></td>
                    <td class="text-center" width="200">
                        <a href="index.php?halaman=detail_tekanan_darah&id=<?php echo $value['id_tekanan_darah']; ?>" class="btn btn-info">Detail</a>
                        <a href="index.php?halaman=hapus_tekanan_darah&id=<?php echo $value['id_tekanan_darah']; ?>" class="btn btn-danger">Hapus</a>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
