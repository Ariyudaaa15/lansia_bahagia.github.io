<?php 
// session_start();
include '../koneksi/konek.php'; // Pastikan file koneksi dihubungkan

// Cek apakah tombol simpan ditekan
if(isset($_POST['simpan'])) {
    // Ambil data dari form
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Hash password sebelum disimpan ke database
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Masukkan data ke dalam database dengan role 'admin'
    $query = mysqli_query($koneksi, "INSERT INTO admin (username, password, role) VALUES ('$username', '$hashedPassword', 'admin')");
    
    // Tampilkan notifikasi jika berhasil atau gagal
    if ($query) {
        echo "<script src='../assets/dist/sweetalert2.all.min.js'></script>";
        echo "<script>
            Swal.fire({
                title: 'Data Berhasil Ditambahkan',
                text: 'User admin baru telah berhasil ditambahkan!',
                icon: 'success'
            }).then(() => {
                window.location.href = 'index.php?halaman=user';
            });
        </script>";
    } else {
        echo "<script src='../assets/dist/sweetalert2.all.min.js'></script>";
        echo "<script>
            Swal.fire({
                title: 'Gagal Menambahkan Data',
                text: 'Terjadi kesalahan saat menambahkan data ke database: " . mysqli_error($koneksi) . "',
                icon: 'error'
            });
        </script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Tambah User Admin</title>

    <!-- CSS -->
    <link href="../assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="../assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="../assets/css/login.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
    <script src="../assets/dist/sweetalert2.all.min.js"></script>
</head>
<body>
    <div class="shadow p-3 bg-white rounded">
        <h5><b>Selamat Datang Di Halaman Tambah User Admin</b></h5>
    </div>

    <form action="" method="POST">
        <div class="card shadow bg-white">
            <div class="card-body">

                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Username  :</label>
                    <div class="col-sm-9">
                        <input type="text" name="username" class="form-control" placeholder="Masukan Username" required>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Password  :</label>
                    <div class="col-sm-9">
                        <input type="password" name="password" class="form-control" placeholder="Masukan Password" required>
                    </div>
                </div>

            </div>

            <div class="card-footer">
                <div class="row">
                    <div class="col-md-11">
                        <button name="simpan" class="btn btn-success">Simpan</button>
                    </div>
                    <div class="col-md-1 text-right">
                        <a href="index.php?halaman=user" class="btn btn-danger">Kembali</a>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <!-- Script -->
    <script src="../assets/vendor/jquery/jquery.min.js"></script>
    <script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/vendor/jquery-easing/jquery.easing.min.js"></script>
</body>
</html>
