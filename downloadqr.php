<?php 

require "session.php";

$id = $_GET['id'];
if (!isset($id) == true) {
        ?>
             <script type="text/javascript">
                alert   ("Data tidak valid");
                window.location.href="?page=dashboard";
             </script>
        <?php
        exit;
    }
$sql = $conn->query("select * from databarang where noidb='$id'");

$dataqr = $sql->fetch_assoc();

 ?>

<!DOCTYPE html>
<html>
<head>
 	<meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>KODE QR-APASA V2</title>
    <meta name="viewport" content="width=device-width, minimum-scale=1, maximum-scale=1">
    <link rel="shortcut icon" type="image/png" href="assets/images/icon/favicon.ico">
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
    <!-- modernizr css -->
    <script src="assets/js/vendor/modernizr-2.8.3.min.js"></script>
</head>
<body>
<br>
    <div class="col-md-4 col-md-offset-2" >
    	<table class="table table-bordered" style="border-width: 2px; border-color: black;">            	
            <tr>
                <td rowspan="2" style="width: 30px; text-align: center; vertical-align: middle;"><img src="temp/rt-<?php echo $dataqr['idbarang']; ?>.png"></td>
                <td rowspan="1" style="width: 20px; vertical-align: middle;"><b>KPPBC TMP B ATAMBUA</b></td>
            </tr>
            <tr>
                <td rowspan="1" style="width: 20px; vertical-align: middle; "><?php echo $dataqr['namabar']; ?></td>
			</tr>			    
        </table>
    </div>

</body>
</html>