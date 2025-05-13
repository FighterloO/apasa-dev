<!-- sudah diupdate -->
<?php 

if ($akses == "Admin" || $akses == "KSBU") {
$id = $_GET ['id'];
$actioncart = "tidak diterima";
$sql = $conn->query("update pengajuancart set actioncart = '$actioncart' where idcart = '$id' ");


 ?>

 <script type="text/javascript">
 		alert	("Data tidak diterima");
 		window.location.href="?page=penerimaanbarang";
 </script>

<?php 
}else{
?>
     <script type="text/javascript">
        alert   ("Akses dilarang");
        window.location.href="index.php?page=dashboard";

     </script>
    <?php
}         


 ?>