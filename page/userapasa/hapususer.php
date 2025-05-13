<!-- sudah diupdate -->

<?php 
if ($akses == "ADMINPDAD") {

$id = $_GET ['id'];

$conn->query("delete from datauser where noID = '$id'");


 ?>

 <script type="text/javascript">
 		alert	("Data Berhasil Dihapus");
 		window.location.href="?page=datauser";

 </script>

<?php 
 }else{

?>
     <script type="text/javascript">
        alert   ("Akses dilarang");
        window.location.href="?page=dashboard";

     </script>
    <?php
}

?>