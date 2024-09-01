<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Data Indeks Massa Tubuh (IMT)</title>
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
        <h5><b>Selamat Datang Di Halaman Tambah Data Indeks Massa Tubuh (IMT)</b></h5>
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
                            include '../koneksi/konek.php'; // Jangan lupa include koneksi database
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
                    <label class="col-sm-3 col-form-label">Berat Badan (kg) :</label>
                    <div class="col-sm-9">
                        <input type="number" id="berat_badan" name="berat_badan" class="form-control" placeholder="Masukan Berat Badan" required>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Tinggi Badan (cm) :</label>
                    <div class="col-sm-9">
                        <input type="number" id="tinggi_badan" name="tinggi_badan" class="form-control" placeholder="Masukan Tinggi Badan" required>
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
                        <a href="index.php?halaman=imt" class="btn btn-danger">Kembali</a>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

<script>
    // Fungsi untuk mengambil nama lansia berdasarkan ID yang dipilih
    function getNamaLansia() {
        const idLansia = document.getElementById('id_lansia').value;
        if (idLansia) {
            $.ajax({
                url: 'get_nama_lansia.php', // Nama file PHP yang menangani AJAX
                type: 'GET',
                data: { id_lansia: idLansia },
                success: function(response) {
                    try {
                        const data = JSON.parse(response);
                        $('#nama_lengkap').val(data.nama_lengkap || '');
                    } catch (e) {
                        console.error('Error parsing JSON response:', e);
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

    // Fungsi untuk menghitung IMT dan memberikan rekomendasi
    $('#hitung').click(function() {
        const beratBadan = parseFloat($('#berat_badan').val());
        const tinggiBadan = parseFloat($('#tinggi_badan').val());

        if (!beratBadan || !tinggiBadan) {
            $('#hasil_analisis').html('<b>Silakan masukkan berat badan dan tinggi badan yang valid.</b>');
            return;
        }

        const tinggiMeter = tinggiBadan / 100; // Mengubah tinggi badan ke meter
        const imt = beratBadan / (tinggiMeter * tinggiMeter); // Menghitung IMT
        let hasil = '';
        let rekomendasi = '';

        // Menghitung hasil berdasarkan nilai IMT
        if (imt < 18.5) {
            hasil = 'Berat badan dikatakan kurang';
            rekomendasi = 'Rekomendasi: Perbaiki nutrisi, kurangi stres, terapi fisik.';
        } else if (imt >= 18.5 && imt < 23) {
            hasil = 'Berat badan normal';
            rekomendasi = 'Rekomendasi: Tidak ada tindakan khusus diperlukan.';
        } else if (imt >= 23 && imt < 30) {
            hasil = 'Berat badan dikatakan berlebihan (kecenderungan obesitas)';
            rekomendasi = 'Rekomendasi: Rubah gaya hidup (pola makan, aktivitas fisik, dan mobilitas).';
        } else {
            hasil = 'Obesitas';
            rekomendasi = 'Rekomendasi: Rubah gaya hidup (pola makan, aktivitas fisik, dan mobilitas).';
        }

        // Menampilkan hasil analisis di halaman
        $('#hasil_analisis').html(`<b>${hasil}</b><br>${rekomendasi}`);
    });
</script>

</body>
</html>
