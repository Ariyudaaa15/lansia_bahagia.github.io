<?php

include '../koneksi/konek.php';

if (isset($_GET['id'])) {
    $id_kolestrol = $_GET['id'];

    // Jika ada konfirmasi penghapusan dari SweetAlert2
    if (isset($_POST['confirm_delete'])) {
        // Hapus data tekanan darah dari database
        $query = mysqli_query($koneksi, "DELETE FROM kolestrol_total WHERE id_kolestrol='$id_kolestrol'");

        if ($query) {
            // Notifikasi penghapusan berhasil
            echo "<script src='../assets/dist/sweetalert2.all.min.js'></script>";
            echo "<script>
                Swal.fire({
                    title: 'Terhapus!',
                    text: 'Data tekanan darah telah dihapus.',
                    icon: 'success'
                }).then(() => {
                    window.location.href = 'index.php?halaman=kolestrol_total';
                });
            </script>";
        } else {
            echo "<script src='../assets/dist/sweetalert2.all.min.js'></script>";
            echo "<script>
                Swal.fire({
                    title: 'Gagal!',
                    text: 'Terjadi kesalahan saat menghapus data: " . mysqli_error($koneksi) . "',
                    icon: 'error'
                }).then(() => {
                    window.location.href = 'index.php?halaman=kolestrol_total';
                });
            </script>";
        }
        exit;
    }
} else {
    echo "<script src='../assets/dist/sweetalert2.all.min.js'></script>";
    echo "<script>
        Swal.fire({
            title: 'Error!',
            text: 'ID tekanan darah tidak ditemukan.',
            icon: 'error'
        }).then(() => {
            window.location.href = 'index.php?halaman=kolestrol_total';
        });
    </script>";
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Konfirmasi Hapus Tekanan Darah</title>
    <script src="../assets/dist/sweetalert2.all.min.js"></script>
</head>

<body>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            Swal.fire({
                title: 'Apakah Anda Yakin?',
                text: 'Data ini akan dihapus!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Jika dikonfirmasi, kirim permintaan POST untuk menghapus data
                    const form = document.createElement('form');
                    form.method = 'POST';
                    form.action = window.location.href;
                    const input = document.createElement('input');
                    input.type = 'hidden';
                    input.name = 'confirm_delete';
                    form.appendChild(input);
                    document.body.appendChild(form);
                    form.submit();
                } else {
                    // Jika dibatalkan, arahkan ke halaman tekanan darah
                    window.location.href = 'index.php?halaman=glukosa_darah_acak';
                }
            });
        });
    </script>
</body>

</html>