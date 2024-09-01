<div class="shadow p-3 bg-white rounded">
    <h5><b>Selamat Datang Di Halaman Detail User</b></h5>
</div>


<?php 

include '../koneksi/konek.php';

    $id_admin = $_GET['id'];

    $ambil = mysqli_query($koneksi, "SELECT * FROM admin WHERE id_admin='$id_admin'");
    $detailadmin = $ambil->fetch_assoc();
?>


<div class="card shadow bg-white mt-3">
    <div class="card-header">
        <strong>Data User Admin</strong>
    </div>
    <div class="card-body">

        <div class="form-group row">
            <label class="col-sm-3 col-form-label">Username :</label>
            <div class="col-sm-9">
                <input disabled class="form-control" value="<?php echo htmlspecialchars($detailadmin['username']); ?>">
            </div>
        </div>

        <div class="form-group row">
            <label class="col-sm-3 col-form-label">Password :</label>
            <div class="col-sm-9">
                <input disabled class="form-control" value="<?php echo htmlspecialchars($detailadmin['password']); ?>">
            </div>
        </div>

    </div>

    <div class="card-footer">
        <div class="row">
            <div class="col-md-11">
                <a href="index.php?halaman=edit_user&id_admin=<?php echo $detailadmin['id_admin']; ?>" class="btn btn-warning">Edit Data</a>
            </div>
            <div class="col-md-1 text-right">
                <a href="index.php?halaman=user" class="btn btn-danger">Kembali</a>
            </div>
        </div>
    </div>
</div>