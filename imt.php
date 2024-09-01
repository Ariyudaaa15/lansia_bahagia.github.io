<?php 
include '../koneksi/konek.php';

// Ambil data IMT dari database
$imt_data = array();
$ambil = $koneksi->query("SELECT imt.id_imt, l.nama_lengkap, imt.berat_badan, imt.tinggi_badan, imt.imt, imt.tanggal_pengukuran
                          FROM imt
                          JOIN lansia l ON imt.id_lansia = l.id_lansia");
while($pecah = $ambil->fetch_assoc()) {
    $imt_data[] = $pecah;
}
?>

<a href="index.php?halaman=tambah_imt" class="btn btn-primary mt-3">Tambah Data</a>

<div class="card shadow bg-white mt-3">
    <div class="card-body">
        <table class="table table-bordered table-hover table-striped" id="tables">
            <thead>
                <tr>
                    <th>No</th>
                    <th>ID IMT</th>
                    <th>Nama Lengkap</th>
                    <th>Berat Badan</th>
                    <th>Tinggi Badan</th>
                    <th>IMT</th>
                    <th>Tanggal Pengukuran</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach ($imt_data as $key => $value): ?>
                <tr>
                    <td width="50"><?php echo $key + 1; ?></td>
                    <td><?php echo $value['id_imt']; ?></td>
                    <td><?php echo $value['nama_lengkap']; ?></td>
                    <td><?php echo $value['berat_badan']; ?></td>
                    <td><?php echo $value['tinggi_badan']; ?></td>
                    <td><?php echo $value['imt']; ?></td>
                    <td><?php echo $value['tanggal_pengukuran']; ?></td>
                    <td class="text-center" width="200">
                        <a href="index.php?halaman=detail_imt&id=<?php echo $value['id_imt']; ?>" class="btn btn-info">Detail</a>
                        <a href="index.php?halaman=hapus_imt&id=<?php echo $value['id_imt']; ?>" class="btn btn-danger">Hapus</a>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
