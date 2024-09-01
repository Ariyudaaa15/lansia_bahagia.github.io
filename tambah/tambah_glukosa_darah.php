<?php 
include '../koneksi/konek.php';

// Proses penyimpanan data jika tombol simpan ditekan
if (isset($_POST['simpan'])) {
    // Ambil dan escape data dari form
    $nama_lengkap = mysqli_real_escape_string($koneksi, $_POST['nama_lengkap']);
    $glukosa_puasa = mysqli_real_escape_string($koneksi, $_POST['glukosa_puasa']);
    $glukosa_sesudah_makan = mysqli_real_escape_string($koneksi, $_POST['glukosa_sesudah_makan']);
    $glukosa_random = mysqli_real_escape_string($koneksi, $_POST['glukosa_random']);

    // Rumus perhitungan hasil analisis glukosa darah
    // Contoh: Jika glukosa puasa di atas 126 dianggap tinggi
    $analisis = '';
    if ($glukosa_puasa > 126) {
        $analisis = 'Glukosa Puasa Tinggi';
    } else {
        $analisis = 'Glukosa Puasa Normal';
    }

    // Masukkan data ke database
    $query = "INSERT INTO glukosa (nama_lengkap, glukosa_puasa, glukosa_sesudah_makan, glukosa_random, analisis) VALUES ('$nama_lengkap', '$glukosa_puasa', '$glukosa_sesudah_makan', '$glukosa_random', '$analisis')";
    $hasil = mysqli_query($koneksi, $query);

    // Cek apakah query berhasil
    if ($hasil) {
        echo "<script src='../assets/dist/sweetalert2.all.min.js'></script>";
        echo "<script>
            Swal.fire({
                title: 'Data Berhasil Ditambahkan',
                text: 'Data glukosa darah telah berhasil ditambahkan!',
                icon: 'success'
            }).then(() => {
                window.location.href = 'index.php?halaman=glukosa';
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

<!-- Form Tambah Data Glukosa Darah -->
<form action="" method="POST">
    <div class="card shadow bg-white">
        <div class="card-body">
            <div class="form-group row">
                <label class="col-sm-3 col-form-label">Nama Lengkap :</label>
                <div class="col-sm-9">
                    <input type="text" name="nama_lengkap" class="form-control" placeholder="Masukkan Nama Lengkap Anda" required>
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-3 col-form-label">Glukosa Puasa :</label>
                <div class="col-sm-9">
                    <input type="number" name="glukosa_puasa" class="form-control" placeholder="Masukkan Nilai Glukosa Puasa" required>
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-3 col-form-label">Glukosa Setelah Makan :</label>
                <div class="col-sm-9">
                    <input type="number" name="glukosa_sesudah_makan" class="form-control" placeholder="Masukkan Nilai Glukosa Setelah Makan" required>
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-3 col-form-label">Glukosa Acak :</label>
                <div class="col-sm-9">
                    <input type="number" name="glukosa_random" class="form-control" placeholder="Masukkan Nilai Glukosa Acak" required>
                </div>
            </div>

        </div>

        <div class="card-footer">
            <button name="simpan" class="btn btn-success">Simpan</button>
            <a href="index.php?halaman=glukosa" class="btn btn-danger">Kembali</a>
            <button type="button" class="btn btn-primary" onclick="hasilAnalisis()">Hasil Analisis</button>
        </div>
    </div>
</form>

<script>
function hasilAnalisis() {
    // Simulasi hasil analisis yang akan ditampilkan
    Swal.fire({
        title: 'Hasil Analisis Glukosa',
        text: 'Analisis berdasarkan nilai glukosa yang dimasukkan.',
        icon: 'info'
    });
}
</script>
