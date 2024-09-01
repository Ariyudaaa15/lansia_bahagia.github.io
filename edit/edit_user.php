<?php 
include '../koneksi/konek.php';
// session_start();

// Cek peran pengguna
$role = isset($_SESSION['role']) ? $_SESSION['role'] : '';

// Cek jika peran pengguna adalah superadmin
if ($role !== 'superadmin') {
    echo "<script src='../assets/dist/sweetalert2.all.min.js'></script>";
    echo "<script>
        Swal.fire({
            title: 'Akses Ditolak',
            text: 'Hanya superadmin yang bisa mengedit data.',
            icon: 'error'
        }).then(() => {
            window.location.href = 'index.php?halaman=user';
        });
    </script>";
    exit();
}

$id_admin = isset($_GET['id_admin']) ? $_GET['id_admin'] : '';

// Ambil data admin berdasarkan id_admin
$ambil = mysqli_query($koneksi, "SELECT * FROM admin WHERE id_admin='$id_admin'");
$edit = $ambil->fetch_assoc();
?>

<div class="shadow p-3 bg-white rounded">
    <h5><b>Selamat Datang Di Halaman Edit User Admin</b></h5>
</div>

<form action="" method="POST">
    <div class="card shadow bg-white">
        <div class="card-body">
            <div class="form-group row">
                <label class="col-sm-3 col-form-label">Username:</label>
                <div class="col-sm-9">
                    <input type="text" name="username" class="form-control" value="<?php echo htmlspecialchars($edit['username']); ?>">
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-3 col-form-label">Password:</label>
                <div class="col-sm-9">
                    <input type="password" name="password" class="form-control" value="<?php echo htmlspecialchars($edit['password']); ?>">
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

<?php 
if (isset($_POST['simpan'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Update Data
    $userUpdate = mysqli_query($koneksi, "UPDATE admin SET username='$username', password='$password' WHERE id_admin='$id_admin'");

    if ($userUpdate) {
        echo "<script src='../assets/dist/sweetalert2.all.min.js'></script>";
        echo "<script>
            Swal.fire({
                title: 'Data Berhasil Diedit',
                text: 'Data user admin telah berhasil diperbarui!',
                icon: 'success'
            }).then(() => {
                window.location.href = 'index.php?halaman=user';
            });
        </script>";
    } else {
        echo "<script src='../assets/dist/sweetalert2.all.min.js'></script>";
        echo "<script>
            Swal.fire({
                title: 'Gagal Mengedit Data',
                text: 'Terjadi kesalahan saat memperbarui data: " . mysqli_error($koneksi) . "',
                icon: 'error'
            });
        </script>";
    }
}
?>
