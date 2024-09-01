<?php 
include '../koneksi/konek.php';

// Proses penyimpanan data jika tombol simpan ditekan
if (isset($_POST['simpan'])) {
    // Ambil dan escape data dari form
    $nama_lengkap = mysqli_real_escape_string($koneksi, $_POST['nama_lengkap']);
    $umur = mysqli_real_escape_string($koneksi, $_POST['umur']);
    $jenis_kelamin = mysqli_real_escape_string($koneksi, $_POST['jenis_kelamin']);
    $alamat = mysqli_real_escape_string($koneksi, $_POST['alamat']);

    // Masukkan data ke database
    $query = "INSERT INTO lansia (nama_lengkap, umur, jenis_kelamin, alamat) VALUES ('$nama_lengkap', '$umur', '$jenis_kelamin', '$alamat')";
    $hasil = mysqli_query($koneksi, $query);

    // Cek apakah query berhasil
    if ($hasil) {
        echo "<script src='../assets/dist/sweetalert2.all.min.js'></script>";
        echo "<script>
            Swal.fire({
                title: 'Data Berhasil Ditambahkan',
                text: 'Data lansia baru telah berhasil ditambahkan!',
                icon: 'success'
            }).then(() => {
                window.location.href = 'index.php?halaman=lansia';
            });
        </script>";
    } else {
        // Menampilkan error jika gagal
        echo "Error: " . mysqli_error($koneksi);
        echo "<script src='../assets/dist/sweetalert2.all.min.js'></script>";
        echo "<script>
            Swal.fire({
                title: 'Gagal Menambahkan Data',
                text: 'Gagal memasukkan data ke database.',
                icon: 'error'
            });
        </script>";
    }
}
?>


<!-- Form Tambah Data Lansia -->
<form action="" method="POST">
    <div class="card shadow bg-white">
        <div class="card-body">
            <div class="form-group row">
                <label class="col-sm-3 col-form-label">Nama Lengkap :</label>
                <div class="col-sm-9">
                    <input type="text" name="nama_lengkap" class="form-control" placeholder="Masukan Nama Lengkap Anda" required>
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-3 col-form-label">Umur :</label>
                <div class="col-sm-9">
                    <input type="number" name="umur" class="form-control" placeholder="Masukan Umur Anda" required>
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-3 col-form-label">Jenis Kelamin :</label>
                <div class="col-sm-9">
                    <select name="jenis_kelamin" class="form-control" required>
                        <option value="">Pilih Jenis Kelamin</option>
                        <option value="Laki - Laki">Laki-laki</option>
                        <option value="Perempuan">Perempuan</option>
                    </select>
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-3 col-form-label">Alamat :</label>
                <div class="col-sm-9">
                    <input type="text" name="alamat" class="form-control" placeholder="Masukan Alamat Anda" required>
                </div>
            </div>

        </div>

        <div class="card-footer">
            <button name="simpan" class="btn btn-success">Simpan</button>
            <a href="index.php?halaman=lansia" class="btn btn-danger">Kembali</a>
        </div>
    </div>
</form>
