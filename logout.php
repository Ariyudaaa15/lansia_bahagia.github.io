<?php 
    // session_start();
    session_destroy();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logout</title>
    <script src="../assets/dist/sweetalert2.all.min.js"></script>
</head>
<body>
    <script>
        Swal.fire({
            title: "Berhasil Logout",
            text: "Anda Telah Berhasil Keluar Dari Halaman Dashboard Admin",
            icon: "success"
        }).then(() => {
            window.location.href = 'login.php';
        });
    </script>
</body>
</html>
