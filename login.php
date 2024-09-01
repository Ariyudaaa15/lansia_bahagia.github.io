<?php
session_start();
include '../koneksi/konek.php';

// Variabel untuk menampung status login
$loginSuccess = false;
$loginError = false;
$noAccount = false;

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Ambil data user berdasarkan username
    $ambil = $koneksi->query("SELECT * FROM admin WHERE username='$username'");
    
    if ($ambil->num_rows == 1) {
        $user = $ambil->fetch_assoc();
        
        // Jika password di database masih dalam format MD5, lakukan migrasi ke password_hash
        if (md5($password) == $user['password']) {
            // Password cocok dengan MD5, sekarang hash ulang dengan password_hash()
            $newHashedPassword = password_hash($password, PASSWORD_DEFAULT);
            
            // Update password di database
            $updateQuery = $koneksi->query("UPDATE admin SET password='$newHashedPassword' WHERE username='$username'");
            
            if ($updateQuery) {
                // Password berhasil di-update, set session dan redirect
                $_SESSION['admin'] = $user;
                $role = $user['role'];
                $loginSuccess = true;

                if ($role == 'superadmin') {
                    $_SESSION['role'] = 'superadmin';
                } else if ($role == 'admin') {
                    $_SESSION['role'] = 'admin';
                }
            } else {
                $loginError = true; // Gagal meng-update password
            }
        } elseif (password_verify($password, $user['password'])) {
            // Password sudah di-hash dengan password_hash(), verifikasi seperti biasa
            $_SESSION['admin'] = $user;
            $role = $user['role'];
            $loginSuccess = true;

            if ($role == 'superadmin') {
                $_SESSION['role'] = 'superadmin';
            } else if ($role == 'admin') {
                $_SESSION['role'] = 'admin';
            }
        } else {
            $loginError = true; // Password salah
        }
    } else {
        $noAccount = true; // Akun tidak ditemukan
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Form Login Admin</title>

    <!-- Fontawesome -->
    <link href="../assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
   
    <!-- Link Ke File CSS -->
    <link rel="stylesheet" href="../assets/css/login.css">

    <!-- Box Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">

    <!-- SweetAlert2 -->
    <script src="../assets/dist/sweetalert2.all.min.js"></script>
</head>
<body>
    <div class="login">
        <div class="avatar">
            <i class="fa fa-user"></i>
        </div>
        <h1>Login Admin</h1>
        <form method="POST" action="">
            <div class="box-login">
                <i class='bx bxs-user'></i>
                <input type="text" name="username" placeholder="Masukan Username Anda" required>
            </div>
            <div class="box-login">
                <i class='bx bxs-key'></i>
                <input type="password" name="password" placeholder="Masukan Password Anda" required>
            </div>
            <button type="submit" name="login" class="btn-login">Login Akun</button>
        </form>
    </div>

    <script src="../assets/vendor/jquery/jquery.min.js"></script>
    <script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="../assets/js/sb-admin-2.min.js"></script>
    <script src="../assets/vendor/fontawesome-free/js/all.min.js"></script>

    <!-- Link BoxIcons Js -->
    <script src="https://unpkg.com/boxicons@2.1.3/dist/boxicons.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            <?php if ($loginSuccess): ?>
                <?php if ($_SESSION['role'] == 'superadmin'): ?>
                    Swal.fire({
                        title: "Selamat Datang Superadmin",
                        text: "Anda Berhasil Login sebagai Superadmin",
                        icon: "success"
                    }).then(() => {
                        window.location.href = 'index.php';
                    });
                <?php else: ?>
                    Swal.fire({
                        title: "Selamat Datang Admin",
                        text: "Anda Berhasil Login sebagai Admin",
                        icon: "success"
                    }).then(() => {
                        window.location.href = 'index.php';
                    });
                <?php endif; ?>
            <?php elseif ($loginError): ?>
                Swal.fire({
                    title: "Gagal Login",
                    text: "Username atau Password salah",
                    icon: "error"
                });
            <?php elseif ($noAccount): ?>
                Swal.fire({
                    title: "Akun Tidak Ditemukan",
                    text: "Periksa Kembali Username Atau Password Anda",
                    icon: "warning"
                });
            <?php endif; ?>
        });
    </script>
</body>
</html>
