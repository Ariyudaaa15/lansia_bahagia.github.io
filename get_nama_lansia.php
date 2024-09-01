<?php
include '../koneksi/konek.php'; // Pastikan path ini benar

// Tangani AJAX request
if (isset($_GET['id_lansia'])) {
    header('Content-Type: application/json');
    $id_lansia = $_GET['id_lansia'];

    // Ambil nama lansia berdasarkan ID
    $stmt = $koneksi->prepare("SELECT nama_lengkap FROM lansia WHERE id_lansia = ?");
    $stmt->bind_param("i", $id_lansia);
    $stmt->execute();
    $result = $stmt->get_result();
    $data = $result->fetch_assoc();

    // Kirimkan data sebagai JSON
    echo json_encode($data);
    exit;
}
?>


<script>
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

    $('#hitung').click(function() {
        const glukosa = parseFloat($('#glukosa_darah').val());
        let hasil = '';

        if (glukosa < 140) {
            hasil = 'Normal. Tidak perlu tindakan khusus.';
        } else if (glukosa >= 140 && glukosa <= 199) {
            hasil = 'Pre-diabetes. Rekomendasi: Kurangi konsumsi gula, olahraga teratur, dan cek kesehatan secara rutin.';
        } else {
            hasil = 'Diabetes. Rekomendasi: Konsultasikan ke dokter, atur pola makan, kontrol kadar gula darah, dan konsumsi obat sesuai anjuran.';
        }

        $('#hasil_analisis').text(hasil);
    });
</script>
