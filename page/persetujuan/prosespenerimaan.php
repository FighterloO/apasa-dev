 <!-- sudah diupdate -->
<?php 



$akses      = $_POST['hakakses'];

if ($akses == "Admin" || $akses == "KSBU") {
	require "../../session.php";

	$count = count($_POST['idbarangout']);
	$tglkeluarcart = date('Y-m-d H:i:s'); 
	
    $kkpegcart  = htmlspecialchars(ucwords(strtolower($_POST['kkpegcart'])));
    $penguruscart  = htmlspecialchars(ucwords(strtolower($_POST['penguruscart'])));
	
	$idajucart = $_POST['idajucart']['0'];

	$updateajucart = $conn->query("update pengajuancart set actioncart = 'diterima', kkpegcart = '$kkpegcart', penguruscart = '$penguruscart' where idcart = '$idajucart'");

    if ($updateajucart) {
                ?>
                    <script type="text/javascript">     
                        alert   ("Data diterima");
                        window.location.href="../../index.php?page=penerimaanbarang";
                    </script>
                 <?php 
              }
 }else{
?>
     <script type="text/javascript">
        alert   ("Akses dilarang");
        window.location.href="../../index.php?page=dashboard";

     </script>
    <?php
}         


 ?>



 