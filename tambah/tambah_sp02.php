<?php
include '../koneksi/konek.php'; // Pastikan jalur koneksi database Anda benar

// Proses penyimpanan data jika tombol simpan ditekan
if (isset($_POST['simpan'])) {
    // Ambil dan escape data dari form
    $id_lansia = mysqli_real_escape_string($koneksi, $_POST['id_lansia']);
    $nama_lengkap = mysqli_real_escape_string($koneksi, $_POST['nama_lengkap']);
    $asam_urat = mysqli_real_escape_string($koneksi, $_POST['asam_urat']);
    $tanggal_pengukuran = mysqli_real_escape_string($koneksi, $_POST['tanggal_pengukuran']);

    // Masukkan data ke database
    $query = "INSERT INTO asam_urat (id_lansia, nama_lengkap, asam_urat, tanggal_pengukuran) VALUES ('$id_lansia', '$nama_lengkap', '$asam_urat', '$tanggal_pengukuran')";
    $hasil = mysqli_query($koneksi, $query);

    // Cek apakah query berhasil
    if ($hasil) {
        echo "<script src='../assets/dist/sweetalert2.all.min.js'></script>";
        echo "<script>
            Swal.fire({
                title: 'Data Berhasil Ditambahkan',
                text: 'Data asam urat telah berhasil ditambahkan!',
                icon: 'success'
            }).then(() => {
                window.location.href = 'index.php?halaman=asam_urat';
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

// Proses AJAX untuk mengambil nama lansia
if (isset($_GET['id_lansia'])) {
    $id_lansia = mysqli_real_escape_string($koneksi, $_GET['id_lansia']);
    $query = "SELECT nama_lengkap FROM lansia WHERE id_lansia = '$id_lansia'";
    $result = $koneksi->query($query);
    if ($result) {
        $data = $result->fetch_assoc();
        echo json_encode($data);
    } else {
        echo json_encode(['nama_lengkap' => '']);
    }
    exit; // Menghentikan eksekusi setelah mengirimkan respons AJAX
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Data Asam Urat</title>
    <link rel="stylesheet" href="../assets/dist/bootstrap.min.css">
    <script src="../assets/dist/sweetalert2.all.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        .hasil-analisis {
            font-size: 1.2em;
            font-weight: bold;
            color: #333;
            margin-top: 20px;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            background-color: #f9f9f9;
        }
    </style>
</head>
<body>
<div class="container mt-4">
    <div class="shadow p-3 mb-4 bg-white rounded">
        <h5><b>Selamat Datang Di Halaman Tambah Data Asam Urat</b></h5>
    </div>

    <form action="" method="POST">
        <div class="card shadow bg-white">
            <div class="card-body">
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">ID Lansia :</label>
                    <div class="col-sm-9">
                        <select name="id_lansia" id="id_lansia" class="form-control" onchange="getNamaLansia()" required>
                            <option value="">Pilih ID Lansia</option>
                            <?php
                            // Mengambil data lansia dari database
                            $result = $koneksi->query("SELECT id_lansia, nama_lengkap FROM lansia");
                            while ($row = $result->fetch_assoc()) {
                                echo "<option value='{$row['id_lansia']}'>{$row['id_lansia']}</option>";
                            }
                            ?>
                        </select>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Nama Lansia :</label>
                    <div class="col-sm-9">
                        <input type="text" id="nama_lengkap" name="nama_lengkap" class="form-control" readonly>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Asam Urat (mg/dL) :</label>
                    <div class="col-sm-9">
                        <input type="number" id="asam_urat" name="asam_urat" class="form-control" placeholder="Masukan Nilai Asam Urat" required>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Tanggal Pengukuran :</label>
                    <div class="col-sm-9">
                        <input type="date" name="tanggal_pengukuran" class="form-control" required>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-sm-12 text-center">
                        <button type="button" id="hitung" class="btn btn-primary">Hitung</button>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-sm-12">
                        <p id="hasil_analisis" class="hasil-analisis"></p>
                    </div>
                </div>

            </div>

            <div class="card-footer">
                <div class="row">
                    <div class="col-md-11">
                        <button name="simpan" class="btn btn-success">Simpan</button>
                    </div>
                    <div class="col-md-1 text-right">
                        <a href="index.php?halaman=asam_urat" class="btn btn-danger">Kembali</a>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

<script>
    // Fungsi untuk mengambil nama lansia berdasarkan ID
    function getNamaLansia() {
        const idLansia = document.getElementById('id_lansia').value;
        if (idLansia) {
            $.ajax({
                url: 'tambah_asam_urat.php', // Menggunakan file yang sama
                type: 'GET',
                data: { id_lansia: idLansia },
                success: function(response) {
                    try {
                        const data = JSON.parse(response);
                        $('#nama_lengkap').val(data.nama_lengkap || '');
                    } catch (e) {
                        console.error('Error parsing JSON response:', e);
                        $('#nama_lengkap').val('');
                    }
                },
                error: function(xhr, status, error) {
                    console.error('AJAX Error:', status, error);
                    $('#nama_lengkap').val('');
                }
            });
        } else {
            $('#nama_lengkap').val('');
        }
    }

    // Fungsi untuk menghitung analisis asam urat
    $('#hitung').click(function() {
        const asamUrat = parseFloat($('#asam_urat').val());
        let hasil = '';
        let rekomendasi = '';

        if (isNaN(asamUrat)) {
            hasil = 'Masukkan nilai asam urat.';
            rekomendasi = '';
        } else if (asamUrat < 3.5) {
            hasil = 'Asam Urat Rendah';
            rekomendasi = 'Rekomendasi: Periksa kembali dengan dokter, karena asam urat terlalu rendah.';
        } else if (asamUrat >= 3.5 && asamUrat <= 7) {
            hasil = 'Asam Urat Normal';
            rekomendasi = 'Rekomendasi: Tidak ada tindakan khusus diperlukan.';
        } else if (asamUrat > 7) {
            hasil = 'Asam Urat Tinggi';
            rekomendasi = 'Rekomendasi: Rubah pola makan, hindari makanan dengan kandungan tinggi purin (jeroan, makanan laut, alkohol), perbanyak air putih, kurangi berat badan.';
        }

        // Menampilkan hasil analisis dan rekomendasi
        $('#hasil_analisis').html(`<b>${hasil}</b><br>${rekomendasi}`);
    });
</script>

</body>
</html>
