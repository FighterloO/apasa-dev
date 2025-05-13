 <!-- sudah diupdate -->
 <?php 

  require "../../session.php";
  
  $akses      = $_POST['hakakses'];
  
if ($akses == "KSBU") {
  $count = count($_POST['idbarangout']);
  $tgladminqr = date('Y-m-d H:i:s'); 
  $adminqr = $_SESSION['nama'];
  $idajucart = $_POST['idajucart']['0'];


$tahunspmb = date('Y');
$queryspmb = $conn->query("SELECT MAX(kodespmb) as kodespmb FROM nospmb WHERE year(tglspmb) ='$tahunspmb'");
$tampilkodespmb = $queryspmb->fetch_assoc();
$resultspmb = $tampilkodespmb['kodespmb'];
if ($resultspmb != 0) {
  $nospmb = $resultspmb + 1;
}else{
  $nospmb = 1;
}

$notapersetujuan = "SPMB-".$nospmb.$KodeKantorBC."/".$tahunspmb;

$inputnospmb = $conn->query("insert into nospmb (tglspmb, kodespmb) values('$tgladminqr', '$nospmb')");

  for ($i=0; $i < $count; $i++) { 
    $sql = "INSERT INTO `pengajuanqr` (`namabarqr`,`idbarangqr`,`tanggalajuqr`,`stockajuqr`,`satuanajuqr`,`namapegqr`,`seksiajuqr`,`actionqr`,`idpengajuancart`) VALUES ('{$_POST['namabarout'][$i]}','{$_POST['idbarangout'][$i]}','{$_POST['tglkeluar'][$i]}','{$_POST['stockout'][$i]}','{$_POST['satuanout'][$i]}','{$_POST['namapegout'][$i]}','{$_POST['seksiout'][$i]}','disetujui','$idajucart')";
    $conn->query($sql);
  }

  $updateajucart = $conn->query("update pengajuancart set actioncart = 'disetujui', adminqr = '$adminqr', tgladminqr = '$tgladminqr', nospmb = '$notapersetujuan' where idcart = '$idajucart'");

    if ($updateajucart) {
                ?>
                    <script type="text/javascript">     
                        alert   ("Data disetujui");
                        window.location.href="../../index.php?page=persetujuanbarang";
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
