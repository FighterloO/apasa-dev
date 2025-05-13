
<?php 

require "session.php";

$bye = $_SESSION['noID'];
$get = $_SESSION['nama'];

$seksi = $_SESSION['seksi'];
$nip = $_SESSION['nip'];

if (isset($bye) == true && isset($get) == true && isset($seksi) == true && isset($nip) == true) {
        
    }else{
        ?>
             <script type="text/javascript">
                alert   ("Data tidak valid");
                window.location.href="?page=dashboard";
             </script>
        <?php
        exit;
    }

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

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <title>APASA V2</title>
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

<div class="col-xl-12 col-lg-6 mt-5">
        <div class="card">
                <div class="card-body">
                <h4 class="header-title">Data Barang APASA, di Print Pada Tanggal : <?php echo $tglhariini." ".$jam; ?></h4>
                    <div class="table-responsive data-tables datatable-dark" >
                        <table id="myTable" class="table table-striped table-bordered table-hover">
                            <thead class="text-capitalize">
                                <thead style="background-color: white; color: black;">
                                    <th style="width: 2%;  text-align: center;" >No</th>
                                    <th style="width: 8%;  text-align: center;" >Foto</th>
                                    <th style="width: 20%;  text-align: center;" >Nama Barang</th>
                                    <th style="width: 15%;  text-align: center;" >Id Barang</th>
                                    <th style="width: 15%;  text-align: center;" >Terakhir Update</th>
                                    <th style="width: 10%;  text-align: center;" >Stock/Satuan</th>
                                    
                                   
                                </thead>
                            </thead>
                            <tbody>
                                <?php 
                                function formatTanggal($date){
                                     // menggunakan class Datetime
                                     $datetime = DateTime::createFromFormat('Y-m-d H:i:s', $date);
                                     return $datetime->format('d-m-Y H:i:s');
                                    }

                                  $no =1;
                                  $sql = $conn->query("select * from databarang ORDER by namabar ASC");

                                  while ($data=$sql->fetch_assoc()){
                                 ?>
                              <tr>
                                <td align="center"><?php echo $no++; ?></td>
                                <td align="center"><img src="imgbarang/<?php echo $data['foto']; ?>" style="width: 50px; height: 50px;"></td>
                                <td align="center"><?php echo $data['namabar']; ?></td>
                                <td align="center"><?php echo $data['idbarang']; ?></td>
                                <td align="center"><?php echo formatTanggal($data['tglbarang']); ?></td>
                                <td align="center"><?php echo $data['stock']."/". $data['satuan']; ?></td>
                                
                              </tr>

                              <?php } ?>        
                            </tbody>
                        </table>
                    </div>