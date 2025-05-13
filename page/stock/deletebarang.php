<!-- sudah diupdate -->
<?php 
if ($akses == "ADMINPDAD" || $akses == "Admin" || $akses == "KSBU") {

$id = $_GET ['id'];

$sql = $conn->query("select * from databarang where noidb='$id'");

$deletebarang = $sql->fetch_assoc();

$namafile = $deletebarang['foto'];
$hapusqr = $deletebarang['idbarang'];
$qrfile = "rt-".$hapusqr.".png";

unlink("imgbarang/$namafile");
unlink("temp/$qrfile");

$apabilahapus = $conn->query("delete from databarang where noidb = '$id'");


if ($apabilahapus) {
 ?>
 <script type="text/javascript">
 		alert	("Data Berhasil Dihapus");
 		window.location.href="?page=ubahsessionstockbarang";

 </script>


 <?php 
}
}else{

?>
     <script type="text/javascript">
        alert   ("Akses dilarang");
        window.location.href="?page=dashboard";

     </script>
    <?php
}
?>