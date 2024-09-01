<?php 
session_start();
include '../koneksi/konek.php';

// Cek apakah session 'admin' ada
if (!isset($_SESSION['admin'])) {
    echo "<!DOCTYPE html>
    <html lang='en'>
    <head>
        <meta charset='UTF-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <title>Peringatan</title>
        <script src='../assets/dist/sweetalert2.all.min.js'></script>
    </head>
    <body>
        <script>
            Swal.fire({
                title: 'Peringatan',
                text: 'Anda Harus Login Terlebih Dahulu',
                icon: 'warning',
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'Ok'
            }).then(() => {
                window.location.href = 'login.php';
            });
        </script>
    </body>
    </html>";
    exit();
}

// Cek hak akses dan tampilkan menu sesuai peran
$user_role = $_SESSION['admin']['role'];
?>



<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Dashbaord Admin</title>

    <!-- Custom fonts for this template-->
    <link href="../assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="../assets/css/sb-admin-2.min.css" rel="stylesheet">

        <!-- Custom styles for this page -->
        <link href="../assets/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
        
         <!-- Sweet Alert JS-->
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.12.3/dist/sweetalert2.all.min.js" integrity="sha256-5Eneyg9KFsV9wx0iFJvBWBkF4S99IzuKfaLCxXGkGjs=" crossorigin="anonymous"></script>

        <!-- SweetAlert CSS-->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.12.3/dist/sweetalert2.min.css" integrity="sha256-KIZHD6c6Nkk0tgsncHeNNwvNU1TX8YzPrYn01ltQwFg=" crossorigin="anonymous">
</head>


<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-dark sidebar sidebar-dark text-white accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
                <div class="sidebar-brand-icon">
                    <i class="fas fa-laugh-wink"></i>
                </div>
                <div class="sidebar-brand-text mx-3">Lansia Bahagia</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
        
            <li class="nav-item">
                <a class="nav-link" href="index.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="index.php?halaman=lansia">
                        <i class="fas fa-fw fa-users"></i>
                        <span>Data Lansia</span></a>
                </li>
            
            <li class="nav-item">
                <a class="nav-link" href="index.php?halaman=tekanan_darah">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Tekanan Darah</span></a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="index.php?halaman=glukosa_darah">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Glukosa Darah</span></a>
            </li>


            <li class="nav-item">
                <a class="nav-link" href="index.php?halaman=glukosa_darah_puasa">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Glukosa Darah Puasa</span></a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="index.php?halaman=glukosa_darah_acak">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Glukosa Darah Acak</span></a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="index.php?halaman=glukosa_darah_2_jpp">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Glukosa Darah 2 JPP</span></a>
            </li>


            <li class="nav-item">
                <a class="nav-link" href="index.php?halaman=asam_urat">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Asam Urat</span></a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="index.php?halaman=imt">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Indeks Massa Tubuh (IMT)</span></a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="index.php?halaman=kolestrol_total">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Kolestrol Total</span></a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="index.php?halaman=sp02">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Saturasi Oksigen (SpO2)</span></a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="index.php?halaman=user">
                    <i class="fas fa-fw fa-user"></i>
                    <span>Tambah User</span></a>
            </li>

                

            <li class="nav-item">
                <a class="nav-link" href="index.php?halaman=logout">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Logout</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <!-- <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button> -->

                    <!-- Topbar Search -->
                    <!-- <form
                        class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                        <div class="input-group">
                            <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..."
                                aria-label="Search" aria-describedby="basic-addon2">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="button">
                                    <i class="fas fa-search fa-sm"></i>
                                </button>
                            </div>
                        </div>
                    </form> -->

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                      

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                  

                
                  
                        
                        <?php 
                        if(isset($_GET['halaman']))
                        
                        // Halaman Produk
                  
                        {
                            if($_GET['halaman']=="lansia")
                            {
                                include 'lansia.php';
                            }
                            elseif($_GET['halaman']=="tambah_lansia")
                            {
                                include 'tambah/tambah_lansia.php';
                            }
                     
                            elseif($_GET['halaman']=="detail_lansia")
                            {
                                include 'detail/detail_lansia.php';
                            }
                            elseif($_GET['halaman']=="edit_lansia")
                            {
                                include 'edit/edit_lansia.php';
                            }
                            elseif($_GET['halaman']=="hapus_lansia")
                            {
                                include 'hapus/hapus_lansia.php';
                            }
                            // Halaman Logout
                            elseif($_GET['halaman']=="logout")
                            {
                                include 'logout.php';
                            }

                            // Halaman Tentang Kami
                            if($_GET['halaman']=="tekanan_darah")
                            {
                                include 'tekanan_darah.php';
                            }
                            elseif($_GET['halaman']=="tambah_tekanan_darah")
                            {
                                include 'tambah/tambah_tekanan_darah.php';
                            }
                            elseif($_GET['halaman']=="detail_tekanan_darah")
                            {
                                include 'detail/detail_tekanan_darah.php';
                            }
                            elseif($_GET['halaman']=="edit_tekanan_darah")
                            {
                                include 'edit/edit_tekanan_darah.php';
                            }
                            elseif($_GET['halaman']=="hapus_tekanan_darah")
                            {
                                include 'hapus/hapus_tekanan_darah.php';
                            }


                            if($_GET['halaman']=="glukosa_darah")
                            {
                                include 'glukosa_darah.php';
                            }
                            elseif($_GET['halaman']=="tambah_glukosa_darah")
                            {
                                include 'tambah/tambah_glukosa_darah.php';
                            }
                            elseif($_GET['halaman']=="detail_glukosa_darah")
                            {
                                include 'detail/detail_glukosa_darah.php';
                            }
                            elseif($_GET['halaman']=="edit_glukosa_darah")
                            {
                                include 'edit/edit_glukosa_darah.php';
                            }
                            elseif($_GET['halaman']=="hapus_glukosa_darah")
                            {
                                include 'hapus/hapus_glukosa_darah.php';
                            }

                            if($_GET['halaman']=="glukosa_darah_puasa")
                            {
                                include 'glukosa_darah_puasa.php';
                            }
                            elseif($_GET['halaman']=="tambah_glukosa_darah_puasa")
                            {
                                include 'tambah/tambah_glukosa_darah_puasa.php';
                            }
                            elseif($_GET['halaman']=="detail_glukosa_darah_puasa")
                            {
                                include 'detail/detail_glukosa_darah_puasa.php';
                            }
                            elseif($_GET['halaman']=="edit_glukosa_darah_puasa")
                            {
                                include 'edit/edit_glukosa_darah_puasa.php';
                            }
                            elseif($_GET['halaman']=="hapus_glukosa_darah_puasa")
                            {
                                include 'hapus/hapus_glukosa_darah_puasa.php';
                            }



                            if($_GET['halaman']=="glukosa_darah_acak")
                            {
                                include 'glukosa_darah_acak.php';
                            }
                            elseif($_GET['halaman']=="tambah_glukosa_darah_acak")
                            {
                                include 'tambah/tambah_glukosa_darah_acak.php';
                            }
                            elseif($_GET['halaman']=="detail_glukosa_darah_acak")
                            {
                                include 'detail/detail_glukosa_darah_acak.php';
                            }
                            elseif($_GET['halaman']=="edit_glukosa_darah_acak")
                            {
                                include 'edit/edit_glukosa_darah_acak.php';
                            }
                            elseif($_GET['halaman']=="hapus_glukosa_darah_acak")
                            {
                                include 'hapus/hapus_glukosa_darah_acak.php';
                            }


                            if($_GET['halaman']=="glukosa_darah_2_jpp")
                            {
                                include 'glukosa_darah_2_jpp.php';
                            }
                            elseif($_GET['halaman']=="tambah_glukosa_darah_2_jpp")
                            {
                                include 'tambah/tambah_glukosa_darah_2_jpp.php';
                            }
                            elseif($_GET['halaman']=="detail_glukosa_darah_2_jpp")
                            {
                                include 'detail/detail_glukosa_darah_2_jpp.php';
                            }
                            elseif($_GET['halaman']=="edit_glukosa_darah_2_jpp")
                            {
                                include 'edit/edit_glukosa_darah_2_jpp.php';
                            }
                            elseif($_GET['halaman']=="hapus_glukosa_darah_2_jpp")
                            {
                                include 'hapus/hapus_glukosa_darah_2_jpp.php';
                            }



                            if($_GET['halaman']=="kolestrol_total")
                            {
                                include 'kolestrol_total.php';
                            }
                            elseif($_GET['halaman']=="tambah_kolestrol_total")
                            {
                                include 'tambah/tambah_kolestrol_total.php';
                            }
                            elseif($_GET['halaman']=="detail_kolestrol_total")
                            {
                                include 'detail/detail_kolestrol_total.php';
                            }
                            elseif($_GET['halaman']=="edit_kolestrol_total")
                            {
                                include 'edit/edit_kolestrol_total.php';
                            }
                            elseif($_GET['halaman']=="hapus_kolestrol_total")
                            {
                                include 'hapus/hapus_kolestrol_total.php';
                            }


                            if($_GET['halaman']=="asam_urat")
                            {
                                include 'asam_urat.php';
                            }
                            elseif($_GET['halaman']=="tambah_asam_urat")
                            {
                                include 'tambah/tambah_asam_urat.php';
                            }
                            elseif($_GET['halaman']=="detail_asam_urat")
                            {
                                include 'detail/detail_asam_urat.php';
                            }
                            elseif($_GET['halaman']=="edit_asam_urat")
                            {
                                include 'edit/edit_asam_urat.php';
                            }
                            elseif($_GET['halaman']=="hapus_asam_urat")
                            {
                                include 'hapus/hapus_asam_urat.php';
                            }


                            if($_GET['halaman']=="imt")
                            {
                                include 'imt.php';
                            }
                            elseif($_GET['halaman']=="tambah_imt")
                            {
                                include 'tambah/tambah_imt.php';
                            }
                            elseif($_GET['halaman']=="detail_imt")
                            {
                                include 'detail/detail_imt.php';
                            }
                            elseif($_GET['halaman']=="edit_imt")
                            {
                                include 'edit/edit_imt.php';
                            }
                            elseif($_GET['halaman']=="hapus_imt")
                            {
                                include 'hapus/hapus_imt.php';
                            }


                            if($_GET['halaman']=="sp02")
                            {
                                include 'sp02.php';
                            }
                            elseif($_GET['halaman']=="tambah_sp02")
                            {
                                include 'tambah/tambah_sp02.php';
                            }
                            elseif($_GET['halaman']=="detail_sp02")
                            {
                                include 'detail/detail_sp02.php';
                            }
                            elseif($_GET['halaman']=="edit_sp02")
                            {
                                include 'edit/edit_sp02.php';
                            }
                            elseif($_GET['halaman']=="hapus_sp02")
                            {
                                include 'hapus/hapus_sp02.php';
                            }



                                // Halaman Tambah User
                            if($_GET['halaman']=="user")
                            {
                                include 'user.php';
                            }
                            elseif($_GET['halaman']=="tambah_user")
                            {
                                include 'tambah/tambah_user.php';
                            }
                            elseif($_GET['halaman']=="detail_user")
                            {
                                include 'detail/detail_user.php';
                            }
                            elseif($_GET['halaman']=="edit_user")
                            {
                                include 'edit/edit_user.php';
                            }
                            elseif($_GET['halaman']=="hapus_user")
                            {
                                include 'hapus/hapus_user.php';
                            }
                            
                        }
                        else
                        
                        // Halaman Dashbaord
                        {
                            include 'dashboard.php';
                        }
                        
                        ?>
                  
                
            

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                         <p>&copy; <?php echo date("Y"); ?> Lansia Bahagia.</p>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="login.html">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="../assets/vendor/jquery/jquery.min.js"></script>
    <script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="../assets/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="../assets/js/sb-admin-2.min.js"></script>

        <!-- Page level plugins -->
    <script src="../assets/vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="../assets/vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="../assets/js/demo/datatables-demo.js"></script>

   <script>
    $(document).on('click', '.simpan', function(){
        Swal.fire({
  title: "The Internet?",
  text: "That thing is still around?",
  icon: "question"
});
    });
   </script>

</body>

</html>