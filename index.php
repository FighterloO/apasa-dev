
<?php 

require "session.php";

$bye = $_SESSION['noID'];
$get = $_SESSION['nama'];
$akses = $_SESSION['hakaksesapasa'];
$seksi = $_SESSION['seksi'];
$nip = $_SESSION['nip'];

$jam = date ("H:i:s");

$tglhariini= date('Y-m-d');

$tuday= date('l');

$tudaytgl= date('d-m-Y');

switch ($tuday) {
    case 'Sunday':
        $tuday = "Minggu";
        break;
    case 'Monday':
        $tuday = "Senin";
        break;
    case 'Tuesday':
        $tuday = "Selasa";
        break;
    case 'Wednesday':
        $tuday = "Rabu";
        break;
    case 'Thursday':
       $tuday = "Kamis";
        break;
    case 'Friday':
        $tuday = "Jumat";
        break;
    case 'Saturday':
        $tuday = "Sabtu";
        break;
    default:
        break;
}
?>

<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <title>APASA V2</title>
    
    <style type="text/css">
         @media screen and (max-width:1000px){ 
         html{ overflow-x: hidden; }
            }
            .alerttambahbarang {
              display: none;
              padding: 10px;
              background-color: #18ed1b;
              color: white;
              position: fixed;
              top: 10px;
              right: 10px;
              z-index: 1;
              animation: fadeOut 4s;
            }
            
            .alerttambahbarang2 {
              display: none;
              padding: 10px;
              background-color: #e60909;
              color: white;
              position: fixed;
              top: 10px;
              right: 10px;
              z-index: 1;
              animation: fadeOut 4s;
            }
            
            @keyframes fadeOut {
              0% {
                opacity: 1;
              }
              90% {
                opacity: 1;
              }
              100% {
                opacity: 0;
                display: none;
              }
            }
        
    </style>
    <style type="text/css">
        /* Back to Top Pure CSS by igniel.com */
    html {scroll-behavior:smooth;}
    .ignielToTop {width:50px; height:50px; position:fixed; bottom:50px; right: 50px; z-index:99; cursor:pointer; border-radius:100px; transition:all .5s; background:black url("data:image/svg+xml,%3Csvg viewBox='0 0 24 24' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M7.41,15.41L12,10.83L16.59,15.41L18,14L12,8L6,14L7.41,15.41Z' fill='%23fff'/%3E%3C/svg%3E") no-repeat center center;}
    .ignielToTop:hover {background:navy url("data:image/svg+xml,%3Csvg viewBox='0 0 24 24' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M7.41,15.41L12,10.83L16.59,15.41L18,14L12,8L6,14L7.41,15.41Z' fill='%23fff'/%3E%3C/svg%3E") no-repeat center center;}
    </style>
    <style type='text/css'>
        html {
          overflow-x: hidden;
        }
    </style> 
    <meta name="viewport" content="width=device-width, minimum-scale=1, maximum-scale=1">
    <link rel="icon" type="image/png" href="assets/images/icon/logotitle.png">
    <link rel="shortcut icon" type="image/png" href="assets/images/icon/logotitle.png">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/themify-icons.css">
    <link rel="stylesheet" href="assets/css/metisMenu.css">
    <link rel="stylesheet" href="assets/css/owl.carousel.min.css">
    <link rel="stylesheet" href="assets/css/slicknav.min.css">
    <!-- amchart css -->
    <link rel="stylesheet" href="https://www.amcharts.com/lib/3/plugins/export/export.css" type="text/css" media="all" />
    <!-- others css -->
    <link rel="stylesheet" href="assets/css/typography.css">
    <link rel="stylesheet" href="assets/css/default-css.css">
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="stylesheet" href="assets/css/responsive.css">
    <link rel="stylesheet" type="text/css" href="assets/dataTables/datatables.min.css"/>
    <link rel="stylesheet" href="assets/css/responsive.css">
    <link rel="stylesheet" href="assets/css/tracker.css"> 
    <!-- modernizr css -->
    <script src="assets/js/vendor/modernizr-2.8.3.min.js"></script>
</head>


<body>
    <!-- preloader area start -->
    <div id="preloader">
        <div class="loader"></div>
    </div>
    <!-- preloader area end -->
    <!-- page container area start -->
    <div class="page-container">
        <!-- sidebar menu area start -->
        <div class="sidebar-menu">
            <div class="sidebar-header">
                <div class="logo">
                    <a href="?page=dashboard"><img style="width:90px;height:70px;" src="assets/images/logobckuning.png" alt="logo"></a>
                </div>
            </div>
            <div class="main-menu">
                <div class="menu-inner">
                    <nav>
                        <ul class="metismenu" id="menu">
                            <li>
                                <a href="?page=keranjang" aria-expanded="true"><i class="ti-shopping-cart"></i><span>Keranjang Pengajuan</span></a>
                                
                            </li>
                            <?php 
                                if ($akses == "ADMINPDAD" || $akses == "Admin" || $akses == "KSBU") {  
                            ?>
                            <li>
                                <a href="javascript:void(0)" aria-expanded="true"><i class=" ti-check-box "></i><span>Admin
                                    <!-- notif bintang merah -->
                                    <?php 

                                    $notifmenu = $conn->query("select * from pengajuancart where actioncart='ajukan' || actioncart='diterima'");
                                    $notifmenukeluar = $conn->query("select * from pengajuanqr where actionqr='disetujui'");
                                    $notifmenu12=$notifmenu->fetch_assoc();
                                    $notifmenukeluar12=$notifmenukeluar->fetch_assoc();
                                    if ($notifmenu12 > 0 || $notifmenukeluar12 > 0 ) {
                                       echo "<span style='color: red;'>*</span>";
                                    }

                                     ?>
                                </span></a>
                                <ul class="collapse">
                                    <li><a href="?page=penerimaanbarang">Penerimaan
                                        <!-- notif jumlah penerimaan -->
                                <?php 

                                    $notifterima = $conn->query("select * from pengajuancart where actioncart='ajukan'");

                                        while ($notifterima3=$notifterima->fetch_array()){
                                            $notifterima4[] = $notifterima3;
                                        }
                                    if (isset($notifterima4)) {
                                        $notifterima5 = count($notifterima4);
                                        echo "<span style='color: #3872cf;'>".$notifterima5."</span>";
                                    }else{
                                         echo "<span style='color: #3872cf;'>0</span>";
                                    }    
                                ?>
                                    
                                    </a></li>
                                    <?php 
                                        if ($akses == "KSBU" || $akses == "ADMINPDAD") {  
                                    ?>
                                    <li><a href="?page=persetujuanbarang">Persetujuan
                                         <!-- notif jumlah persetujuan -->
                                <?php 

                                    $notifsetuju = $conn->query("select * from pengajuancart where actioncart='diterima'");

                                        while ($notifsetuju3=$notifsetuju->fetch_array()){
                                            $notifsetuju4[] = $notifsetuju3;
                                        }
                                    if (isset($notifsetuju4)) {
                                        $notifsetuju5 = count($notifsetuju4);
                                        echo "<span style='color: #3872cf;'>".$notifsetuju5."</span>";
                                    }else{
                                         echo "<span style='color: #3872cf;'>0</span>";
                                    }    
                                ?>        

                                    </a></li>
                                    <?php 
                                        }
                                    ?>
                                    <li><a href="?page=pengeluaranbarang">Pengeluaran
                                        <!-- notif jumlah pengeluaran -->
                                <?php 

                                    $notifkeluar = $conn->query("select * from pengajuanqr where actionqr='disetujui'");

                                        while ($notifkeluar3=$notifkeluar->fetch_array()){
                                            $notifkeluar4[] = $notifkeluar3;
                                        }
                                    if (isset($notifkeluar4)) {
                                        $notifkeluar5 = count($notifkeluar4);
                                        echo "<span style='color: #3872cf;'>".$notifkeluar5."</span>";
                                    }else{
                                         echo "<span style='color: #3872cf;'>0</span>";
                                    }    
                                ?>        
                                    </a></li>                                    
                                </ul>
                            </li>
                            <?php 
                                }
                            ?>
                            <!--<li>-->
                            <!--    <a href="?page=dashboard" aria-expanded="true"><i class="ti-dashboard"></i><span>dashboard</span></a>-->
                                
                            <!--</li>                           -->
                            <li>
                                <a href="javascript:void(0)" aria-expanded="true"><i class="ti-receipt"></i><span>Cek</span></a>
                                <ul class="collapse">
                                    <li><a href="?page=catatanpengajuan">Nota Pengajuan</a></li>
                                    <?php 
                                       if ($akses == "ADMINPDAD" || $akses == "Admin" || $akses == "KSBU") {  
                                    ?>
                                    <li><a href="?page=filterallcp">Nota Pengajuan (Admin)</a></li>                   
                                    <li><a href="?page=logbarang">Log Pengeluaran</a></li>
                                    <?php 
                                        }
                                    ?>
                                </ul>
                            </li>
                            <li>
                                <a href="javascript:void(0)" aria-expanded="true"><i class="fa fa-table"></i><span>Stock Barang</span></a>
                                <ul class="collapse">
                                    <?php 
                                       if ($akses == "ADMINPDAD" || $akses == "Admin" || $akses == "KSBU") {  
                                    ?>
                                    <li><a href="?page=logmasuk">Log Masuk</a></li>
                                    <li><a href="?page=tambahstock">Tambah Jenis Barang</a></li>
                                    <?php 
                                        }
                                    ?>
                                    <li><a href="?page=stockbarang">Stock Barang</a></li>
                                </ul>
                            </li>
                            <?php 
                               if ($akses == "ADMINPDAD" || $akses == "Admin" || $akses == "KSBU") {  
                            ?>
                            <li>
                                <a href="javascript:void(0)" aria-expanded="true"><i class="ti-layers-alt"></i> <span>Report</span></a>
                                <ul class="collapse">
                                    <li><a href="reportlaporan.php">Data Barang</a></li>
                                    <li><a href="?page=reportcsv">Cetak CSV</a></li>
                                    <li><a href="?page=filterspmb">Cetak SPMB</a></li>
                                </ul>
                            </li>
                            <?php 
                                }
                            ?>
                            <li>
                                <a href="javascript:void(0)" aria-expanded="true"><i class="ti-user"></i><span>Akun</span></a>
                                <ul class="collapse">
                                    <?php 
                                      if ($akses == "ADMINPDAD") {  

                                    ?>
                                    <li><a href="?page=tambahuser">Tambah Data</a></li>
                                    <li><a href="?page=datauser">Datauser</a></li>
                                    <?php 
                                     }
                                    ?>
                                    <li><a href="?page=ubahpass">Ubah Password</a></li>
                                    <li><a href="logout.php">Logout</a></li>
                                </ul>
                            </li>   
                        </ul>
                    </nav>
                </div>
            </div>
            
                
            
        </div>
        <!-- sidebar menu area end -->
        <!-- main content area start -->
        <div class="main-content">
            <!-- header area start -->
            <div class="header-area">
                <div class="row align-items-center">
                    <!-- nav and search button -->
                    <div class="col-md-6 col-sm-8 clearfix">
                        <div class="nav-btn pull-left">
                            <span></span>
                            <span></span>
                            <span></span>
                        </div>
                        
                    </div>                 
                </div>
            </div>
            <!-- header area end -->
            <!-- page title area start -->
            <div class="page-title-area">
                <div class="row align-items-center">
                    <div class="col-sm-6">
                        <div class="breadcrumbs-area clearfix" style="padding: 5px;">

                            <h4 class="page-title pull-left">SELAMAT DATANG DI APASA</h4>
                            <ul class="breadcrumbs pull-left">
                                <li><a href="#"><?php echo "$get"; ?></a></li>
                                <li><span><?php echo "$tuday, $tudaytgl"; ?></span></li>  
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <!-- page title area end -->
             <!-- /. NAV SIDE  -->
            <div id="page-wrapper" >
                <div id="page-inner">
                    <div class="row">
                        <div class="col-md-12">
                            
                            <div id="myAlertBarang" class="alerttambahbarang">Barang berhasil ditambahkan</div>
                            <div id="myAlertBarang2" class="alerttambahbarang2">Barang gagal ditambahkan</div>
                            <?php 
                                if (isset($_GET['page'])) {
                                    $page = $_GET['page'];
                                }else{
                                    $page = "stockbarang";
                                }
                                
                                
                                // log keluar
                                if ($page == "logbarang") {
                                    include "page/daftar/logbarang.php";   
                                }elseif ($page == "catatanpengajuan") {
                                    include "page/daftar/catatanpengajuan.php"; 
                                }elseif ($page == "infohistory") {
                                    include "page/daftar/infohistory.php"; 
                                }elseif ($page == "allcp") {
                                    include "page/daftar/allcp.php"; 
                                }elseif ($page == "filterallcp") {
                                    include "page/daftar/filterallcp.php"; 
                                }elseif ($page == "clearfilterallcp") {
                                    include "page/daftar/clearfilterallcp.php"; 
                                }elseif ($page == "infoallhistory") {
                                    include "page/daftar/infoallhistory.php"; 
                                }
                                
                                // persetujuan
                                elseif ($page == "persetujuanbarang") {
                                    include "page/persetujuan/persetujuanbarang.php"; 
                                }elseif ($page == "penerimaanbarang") {
                                    include "page/persetujuan/penerimaanbarang.php"; 
                                }elseif ($page == "infopenerimaanbarang") {
                                    include "page/persetujuan/infopenerimaanbarang.php"; 
                                }elseif ($page == "infopersetujuanbarang") {
                                    include "page/persetujuan/infopersetujuanbarang.php"; 
                                }elseif ($page == "pengeluaranbarang") {
                                    include "page/persetujuan/pengeluaranbarang.php"; 
                                }elseif ($page == "prosespersetujuan") {
                                    include "page/persetujuan/prosespersetujuan.php"; 
                                }elseif ($page == "prosespengeluaran") {
                                    include "page/persetujuan/prosespengeluaran.php"; 
                                }elseif ($page == "tolakpenerimaanbarang") {
                                    include "page/persetujuan/tolakpenerimaanbarang.php"; 
                                }elseif ($page == "tolakpersetujuanbarang") {
                                    include "page/persetujuan/tolakpersetujuanbarang.php"; 
                                }elseif ($page == "prosespengeluaransemua") {
                                    include "page/persetujuan/prosespengeluaransemua.php"; 
                                }

                                // keranjang
                                elseif ($page == "qrcart") {
                                    include "page/cart/qrcart.php"; 
                                }elseif ($page == "keranjang") {
                                    include "page/cart/keranjang.php"; 
                                }elseif ($page == "addtocart") {
                                    include "page/cart/addtocart.php"; 
                                }elseif ($page == "hapuscart") {
                                    include "page/cart/hapuscart.php"; 
                                }

                                // dashboard
                                elseif ($page == "dashboard") {
                                    include "page/stock/stockbarang.php"; 
                                }

                                // stock page
                                elseif ($page == "stockbarang") {
                                    include "page/stock/stockbarang.php"; 
                                }elseif ($page == "tambahstock") {
                                    include "page/stock/tambahstock.php"; 
                                }elseif ($page == "ubahbarang") {
                                    include "page/stock/ubahbarang.php"; 
                                }elseif ($page == "infobarang") {
                                    include "page/stock/infobarang.php"; 
                                }elseif ($page == "deletebarang") {
                                    include "page/stock/deletebarang.php"; 
                                }elseif ($page == "logmasuk") {
                                    include "page/stock/logmasuk.php"; 
                                }elseif ($page == "stockbarang1") {
                                    include "page/stock/stockbarang1.php"; 
                                }elseif ($page == "hapuslayout") {
                                    include "page/stock/hapuslayout.php"; 
                                }elseif ($page == "addlayout") {
                                    include "page/stock/addlayout.php"; 
                                }elseif ($page == "ubahsessionstockbarang") {
                                    include "page/stock/ubahsessionstockbarang.php"; 
                                }elseif ($page == "pindahhalaman") {
                                    include "page/stock/pindahhalaman.php"; 
                                }
                                // report
                                elseif ($page == "reportcsv") {
                                    include "page/report/reportcsv.php"; 
                                }elseif ($page == "reportspmb") {
                                    include "page/report/reportspmb.php"; 
                                }elseif ($page == "filterspmb") {
                                    include "page/report/filterspmb.php"; 
                                }elseif ($page == "clearfilterspmb") {
                                    include "page/report/clearfilterspmb.php"; 
                                }elseif ($page == "addlayout") {
                                    include "page/stock/addlayout.php"; 
                                }

                                // user page
                                elseif ($page == "tambahuser") {
                                    include "page/userapasa/tambahuser.php"; 
                                }elseif ($page == "datauser") {
                                    include "page/userapasa/datauser.php";
                                }elseif ($page == "hapususer") {
                                    include "page/userapasa/hapususer.php";
                                }elseif ($page == "ubahuser") {
                                    include "page/userapasa/ubahuser.php";
                                }elseif ($page == "ubahpass") {
                                    include "page/userapasa/ubahpass.php";
                                }elseif ($page == "resetuser") {
                                    include "page/userapasa/resetuser.php";
                                }  
                             ?>
                                <a href="#" class="ignielToTop"></a>
                             <br>
                            <div class="col-lg-12 mt-2">
                                <div class="card">
                                    <div class="card-body">
                                            
                                        <p align="center" class="text-primary"><a href="#">By PDAD BC Atambua</a></p>
                                            
                                    </div>
                                </div>
                            </div>
                             <br>
                        </div>
                    </div>
                     <!-- /. ROW  -->           
                 </div>
                 <!-- /. PAGE INNER  -->
            </div>
                <!-- row area start-->
        </div>
            
    </div>

   
    <!-- jquery latest version -->
    <script src="assets/js/vendor/jquery-2.2.4.min.js"></script>
    <!-- bootstrap 4 js -->
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/owl.carousel.min.js"></script>
    <script src="assets/js/metisMenu.min.js"></script>
    <script src="assets/js/jquery.slimscroll.min.js"></script>
    <script src="assets/js/jquery.slicknav.min.js"></script>

    <!-- start chart js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.min.js"></script>
    <!-- start highcharts js -->
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <!-- start zingchart js -->
    <script src="https://cdn.zingchart.com/zingchart.min.js"></script>
    <script>
    zingchart.MODULESDIR = "https://cdn.zingchart.com/modules/";
    ZC.LICENSE = ["569d52cefae586f634c54f86dc99e6a9", "ee6b7db5b51705a13dc2339db3edaf6d"];
    </script>
    <!-- all line chart activation -->
    <script src="assets/js/line-chart.js"></script>
    <!-- all pie chart -->
    <script src="assets/js/pie-chart.js"></script>
    <!-- others plugins -->
    <script src="assets/js/plugins.js"></script>
    <script src="assets/js/scripts.js"></script>

    <script type="text/javascript" src="assets/dataTables/datatables.min.js"></script>
    <script type="text/javascript">
        $('#myTable').DataTable( {
            responsive: true,
            lengthMenu: [
            [25, 50, -1],
            [25, 50, 'All']
        ]
            } );
    </script>
    
    
    <script>
        function yourFunction(intValue){
                $.ajax({
                    type:'POST',
                    url:'addtocart2.php',
                    data:{id_barang: intValue},
                    success: 
                    function showAlert(message) {
                        
                        if(message == 1){   
                              var alertElement = document.getElementById("myAlertBarang");
                              alertElement.innerText = "Barang berhasil ditambahkan";
                              alertElement.style.display = "block";
                              setTimeout(function() {
                                alertElement.style.display = "none";
                              }, 4000); // Menghilangkan alert setelah 4 detik
                        }else{
                              var alertElement2 = document.getElementById("myAlertBarang2");
                              alertElement2.innerText = "Barang sudah terdapat dalam keranjang";
                              alertElement2.style.display = "block";
                              setTimeout(function() {
                                alertElement2.style.display = "none";
                              }, 4000); // Menghilangkan alert setelah 4 detik
                        };
                   }
                });
        }
    </script>
    
    
    
    
    
    
</body>

</html>