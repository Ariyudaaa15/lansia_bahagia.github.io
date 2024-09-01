<?php

include '../koneksi/konek.php';

if (isset($_GET['id'])) {
    $id_sp02 = $_GET['id'];

    // Jika ada konfirmasi penghapusan dari SweetAlert2
    if (isset($_POST['confirm_delete'])) {
        // Hapus admin dari database
        $query = mysqli_query($koneksi, "DELETE FROM sp02 WHERE id_sp02='$id_sp02'");

        if ($query) {
            // Notifikasi penghapusan berhasil
            echo "<script src='../assets/dist/sweetalert2.all.min.js'></script>";
            echo "<script>
                Swal.fire({
                    title: 'Terhapus!',
                    text: 'Data Anda telah dihapus.',
                    icon: 'success'
                }).then(() => {
                    window.location.href = 'index.php?halaman=sp02';
                });
            </script>";
        } else {
            echo "Gagal menghapus data.";
        }
        exit;
    }

} else {
    echo "ID sp02 tidak ditemukan.";
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Konfirmasi Hapus User Admin</title>
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
                    // Jika dibatalkan, arahkan ke halaman user
                    window.location.href = 'index.php?halaman=sp02';
                }
            });
        });
    </script>
</body>

</html>
