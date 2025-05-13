 <!-- sudah diupdate -->
<?php 

	require "../../session.php";
	
  $akses      = $_GET['hakakses'];
  
if ($akses == "Admin" || $akses == "KSBU") {
   $stockout = $_GET['stockajuqr'];
   $idajuqr = $_GET['idajuqr'];
   $idbarangout = $_GET['idbarangqr'];
   $namapengaju = $_GET['namapengaju'];
   $seksipengaju = $_GET['seksipengaju'];
   $tglkeluarqr = $_GET['tanggalajuqr'];

	$sql = $conn->query("select * from databarang where idbarang ='$idbarangout'");

    $tampil = $sql->fetch_assoc();

   $stocklama = $tampil['stock'];     
   $tglkeluar = date('Y-m-d H:i:s');     
   $adminqr = $_SESSION['nama'];
  
  if ($stocklama < $stockout) {
    ?>
                    <script type="text/javascript">     
                        alert   ("Barang yang disetujui melebihi stock");
                        window.location.href="../../index.php?page=pengeluaranbarang";
                    </script>
                 <?php
   }else{

       	$stockbaru = $stocklama - $stockout;

       	$updateajuqr = $conn->query("update pengajuanqr set actionqr='dikeluarkan', stockajuqr='$stockout', adminkeluar='$adminqr', tglpengeluaran='$tglkeluar' where idajuqr='$idajuqr'");

       	$updatestock = $conn->query("update databarang set stock='$stockbaru', tglbarang='$tglkeluar' where idbarang='$idbarangout'");
  
    if ($updatestock) {
                ?>
                    <script type="text/javascript">     
                        alert   ("Barang dikeluarkan");
                        window.location.href="../../index.php?page=pengeluaranbarang";
                    </script>
                 <?php 
              }
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