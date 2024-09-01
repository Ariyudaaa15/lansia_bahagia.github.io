<div class="shadow p-3 bg-white rounded">
    <h5><b>Selamat Datang Di Halaman Detail Lansia</b></h5>
</div>


<?php 

include '../koneksi/konek.php';

    $id_lansia = $_GET['id'];

    $ambil = mysqli_query($koneksi, "SELECT * FROM lansia WHERE id_lansia='$id_lansia'");
    $detaillansia = $ambil->fetch_assoc();
?>


<div class="card shadow bg-white mt-3">
    <div class="card-header">
        <strong>Data Lansia</strong>
    </div>
    <div class="card-body">

        <div class="form-group row">
            <label class="col-sm-3 col-form-label">Nama Lengkap :</label>
            <div class="col-sm-9">
                <input disabled class="form-control" value="<?php echo htmlspecialchars($detaillansia['nama_lengkap']); ?>">
            </div>
        </div>

        <div class="form-group row">
            <label class="col-sm-3 col-form-label">Umur :</label>
            <div class="col-sm-9">
                <input disabled class="form-control" value="<?php echo htmlspecialchars($detaillansia['umur']); ?>">
            </div>
        </div>

        <div class="form-group row">
            <label class="col-sm-3 col-form-label">Jenis Kelamin :</label>
            <div class="col-sm-9">
                <input disabled class="form-control" value="<?php echo htmlspecialchars($detaillansia['jenis_kelamin']); ?>">
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-3 col-form-label">Alamat :</label>
            <div class="col-sm-9">
                <input disabled class="form-control" value="<?php echo htmlspecialchars($detaillansia['alamat']); ?>">
            </div>
        </div>

    </div>

    <div class="card-footer">
        <div class="row">
            <div class="col-md-11">
                <a href="index.php?halaman=edit_lansia&id_lansia=<?php echo $detaillansia['id_lansia']; ?>" class="btn btn-warning">Edit Data</a>
            </div>
            <div class="col-md-1 text-right">
                <a href="index.php?halaman=user" class="btn btn-danger">Kembali</a>
            </div>
        </div>
    </div>
</div>