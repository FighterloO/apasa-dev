<!-- sudah diupdate -->
<?php 
 if ($akses == "ADMINPDAD" || $akses == "Admin" || $akses == "KSBU" || $akses == "User") {
$idcart = $_GET['id'];

unset($_SESSION['cart'][$idcart]);

 ?>

 <script type="text/javascript">
 		window.location.href="?page=keranjang";
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