<?php 
include '../koneksi/konek.php';
// session_start();

// Ambil data admin dari database
$admin = array();
$ambil = $koneksi->query("SELECT * FROM admin");
while($pecah = $ambil->fetch_assoc()) {
    $admin[] = $pecah;
}

// Cek peran pengguna yang sedang login
$role = isset($_SESSION['role']) ? $_SESSION['role'] : '';

// Cek apakah ada permintaan untuk menghapus data dan pengguna adalah superadmin
if ($role === 'superadmin' && isset($_GET['hapus']) && isset($_GET['id'])) {
    $id = $_GET['id'];
    
    // Hapus data dari database
    $hapus = $koneksi->query("DELETE FROM admin WHERE id_admin = '$id'");

    if ($hapus) {
        echo "<script src='../assets/dist/sweetalert2.all.min.js'></script>";
        echo "<script>
            Swal.fire({
                title: 'Data Berhasil Dihapus',
                text: 'Data user admin telah berhasil dihapus!',
                icon: 'success'
            }).then(() => {
                window.location.href = 'index.php?halaman=user';
            });
        </script>";
    } else {
        echo "<script src='../assets/dist/sweetalert2.all.min.js'></script>";
        echo "<script>
            Swal.fire({
                title: 'Gagal Menghapus Data',
                text: 'Terjadi kesalahan saat menghapus data: " . mysqli_error($koneksi) . "',
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
    <title>Daftar User Admin</title>

    <!-- CSS -->
    <link href="../assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="../assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="../assets/css/login.css">
    <script src="../assets/dist/sweetalert2.all.min.js"></script>
</head>
<body>
    <div class="shadow p-3 bg-white rounded">
        <h5><b>Selamat Datang Di Halaman User Admin</b></h5>
    </div>

    <?php if($role === 'superadmin'): ?>
        <a href="index.php?halaman=tambah_user" class="btn btn-primary mt-3">Tambah Data</a>
    <?php endif; ?>

    <div class="card shadow bg-white mt-3">
        <div class="card-body">
            <table class="table table-bordered table-hover table-striped" id="tables">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Username</th>
                        <th>Password</th> <!-- Password sudah dalam bentuk hash -->
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach ($admin as $key => $value): ?>
                    <tr>
                        <td width="50"><?php echo $key + 1; ?></td>
                        <td><?php echo $value['username']; ?></td>
                        <td><?php echo $value['password']; ?></td> <!-- Menampilkan hash password -->
                        <td class="text-center" width="250">
                            <a href="index.php?halaman=detail_user&id=<?php echo $value['id_admin'] ?>" class="btn btn-info">Detail</a>
                            <?php if($role === 'superadmin'): ?>
                                <a href="#" class="btn btn-danger" onclick="confirmDelete(<?php echo $value['id_admin']; ?>)">Hapus</a>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Script -->
    <script src="../assets/vendor/jquery/jquery.min.js"></script>
    <script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/vendor/jquery-easing/jquery.easing.min.js"></script>

    <script>
        function confirmDelete(id) {
            Swal.fire({
                title: 'Konfirmasi Penghapusan',
                text: "Apakah Anda yakin ingin menghapus data ini?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Hapus',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = 'index.php?halaman=user&hapus=true&id=' + id;
                }
            });
        }
    </script>
</body>
</html>
