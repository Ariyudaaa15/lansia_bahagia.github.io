<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Glukosa Darah Acak</title>
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
        <h5><b>Selamat Datang Di Halaman Tambah Data Glukosa Darah Acak</b></h5>
    </div>

    <form action="" method="POST">
        <div class="card shadow bg-white">
            <div class="card-body">
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">ID Lansia  :</label>
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
                    <label class="col-sm-3 col-form-label">Nama Lansia  :</label>
                    <div class="col-sm-9">
                        <input type="text" id="nama_lengkap" name="nama_lengkap" class="form-control" readonly>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Glukosa Darah (mg/dL) :</label>
                    <div class="col-sm-9">
                        <input type="number" id="glukosa_darah" name="glukosa_darah" class="form-control" placeholder="Masukan Nilai Glukosa Darah" required>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Tanggal Pengukuran  :</label>
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
                        <a href="index.php?halaman=glukosa_acak" class="btn btn-danger">Kembali</a>
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

    // Fungsi untuk menghitung analisis glukosa darah
    $('#hitung').click(function() {
        const glukosa = parseFloat($('#glukosa_darah').val());
        let hasil = '';
        let rekomendasi = '';

        if (glukosa < 70) {
            hasil = 'Glukosa Darah Rendah';
            rekomendasi = 'Rekomendasi: Perbaiki pola makan dan asupan gizi.';
        } else if (glukosa >= 70 && glukosa <= 120) {
            hasil = 'Glukosa Darah Normal';
            rekomendasi = 'Rekomendasi: Tidak ada tindakan khusus diperlukan.';
        } else {
            hasil = 'Glukosa Darah Tinggi';
            rekomendasi = 'Rekomendasi: Rutin cek gula darah, konsultasi ke dokter, perbaiki pola makan.';
        }

        // Menampilkan hasil analisis dan rekomendasi
        $('#hasil_analisis').html(`<b>${hasil}</b><br>${rekomendasi}`);
    });
</script>

</body>
</html>
