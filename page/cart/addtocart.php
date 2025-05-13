<!-- sudah diupdate -->
<?php 
 if ($akses == "ADMINPDAD" || $akses == "Admin" || $akses == "KSBU" || $akses == "User") {
 $idcart = $_GET['id'];

 $_SESSION['cart'][$idcart] = 1;
 
 ?>

 <script type="text/javascript">
 		alert	("Barang telah masuk ke keranjang");
 		window.location.href="?page=ubahsessionstockbarang";
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