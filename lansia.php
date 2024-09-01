<?php 
include '../koneksi/konek.php';

// Ambil data lansia dari database
$lansia = array();
$ambil = $koneksi->query("SELECT * FROM lansia");
while($pecah = $ambil->fetch_assoc()) {
    $lansia[] = $pecah;
}
?>

<a href="index.php?halaman=tambah_lansia" class="btn btn-primary mt-3">Tambah Data</a>

<div class="card shadow bg-white mt-3">
    <div class="card-body">
        <table class="table table-bordered table-hover table-striped" id="tables">
            <thead>
                <tr>
                    <th>No</th>
                    <th>ID Lansia</th>
                    <th>Nama Lengkap</th>
                    <th>Umur</th>
                    <th>Jenis Kelamin</th>
                    <th>Alamat</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach ($lansia as $key => $value): ?>
                <tr>
                    <td><?php echo $key + 1; ?></td>
                    <td><?php echo $value['id_lansia']; ?></td>
                    <td><?php echo $value['nama_lengkap']; ?></td>
                    <td><?php echo $value['umur']; ?></td>
                    <td><?php echo $value['jenis_kelamin']; ?></td>
                    <td><?php echo $value['alamat']; ?></td>
                    <td class="text-center">
                        <a href="index.php?halaman=detail_lansia&id=<?php echo $value['id_lansia']; ?>" class="btn btn-info">Detail</a>
                        <a href="index.php?halaman=hapus_lansia&id=<?php echo $value['id_lansia']; ?>" class="btn btn-danger">Hapus</a>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
