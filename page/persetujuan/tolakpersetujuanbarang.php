<!-- sudah diupdate -->
<?php 
if ($akses == "KSBU") {
$id = $_GET ['id'];
$actioncart = "ditolak";
  $tgladminqr = date('Y-m-d H:i:s'); 
  $adminqr = $_SESSION['nama'];
$sql = $conn->query("update pengajuancart set actioncart = '$actioncart', adminqr = '$adminqr', tgladminqr = '$tgladminqr' where idcart = '$id' ");


 ?>

 <script type="text/javascript">
 		alert	("Data ditolak");
 		window.location.href="?page=persetujuanbarang";
 </script>

<?php 
}else{
?>
     <script type="text/javascript">
        alert   ("Akses dilarang");
        window.location.href="../index.php?page=dashboard";

     </script>
    <?php
}         


 ?>