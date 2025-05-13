<!-- sudah diupdate -->
<?php 

require "../../session.php";

 function getNoSeksi($seksi){
        switch ($seksi){
        case 'PDAD': 
            return "16";
        break;
        case 'UMUM':
            return "01";
        break;
        case 'P2':
            return "02";
        break;
        case 'PERBEND':
            return "03";
        break;
        case 'PKC1':
            return "04";
        break;
        case 'PKC2':
            return "05";
        break;
        case 'PKC3':
            return "06";
        break;
        case 'PKC4':
            return "07";
        break;
        case 'PKC5':
            return "08";
        break;
        case 'PKC6':
            return "09";
        break;
        case 'PKC7':
            return "10";
        break;
        case 'PKC8':
            return "11";
        break;
        case 'PKC9':
            return "12";
        break;
        case 'PKC10':
            return "13";
        break;
        case 'KI':
            return "14";
        break;
        case 'PLI':
            return "15";
        break;
        }
    }
$akses      = $_POST['hakakses'];
 if ($akses == "ADMINPDAD" || $akses == "Admin" || $akses == "KSBU" || $akses == "User") {
$jumlahs     	= $_POST['jumlah'];
if (count($jumlahs) < 3 ) {
   ?>
     <script type="text/javascript">
        alert   ("Dimohon untuk mengajukan barang lebih dari 3 jenis");
        window.location.href="../../index.php?page=keranjang";
     </script>
    <?php
}elseif (count($jumlahs) > 50 ){
    ?>
     <script type="text/javascript">
        alert   ("Dimohon untuk mengajukan barang kurang dari 50 jenis");
        window.location.href="../../index.php?page=keranjang";
     </script>
    <?php
}else{

$catatan        = htmlspecialchars(ucwords($_POST['catatan']));
$nondpengajuan  = htmlspecialchars(strtoupper($_POST['nondpengajuan']));
$pegawaipengajuan  = htmlspecialchars(ucwords(strtolower($_POST['pegawaipengajuan'])));
$keperluan      = htmlspecialchars(strtoupper($_POST['keperluan']));
$namapegcart 	= htmlspecialchars($_POST['namaP']);
$seksiajucart	= htmlspecialchars($_POST['seksi']);
$tanggalajucart = date('Y-m-d H:i:s');
$actioncart		= "ajukan"; 

$seksispb = getNoSeksi($seksiajucart);
$tahunspb = date('Y');
$seksi = $_SESSION['seksi'];
$queryspb = $conn->query("SELECT MAX($seksi) as kodespb FROM nospb WHERE year(tglspb) ='$tahunspb'");
$tampilkodespb = $queryspb->fetch_assoc();
$resultspb = $tampilkodespb['kodespb'];
if ($resultspb != 0) {
	$nospb = $resultspb + 1;
}else{
	$nospb = 1;
}

$notapengajuan = "SPB-".$nospb.$KodeKantorBC.$seksispb."/".$tahunspb;

$inputnospb = $conn->query("insert into nospb (tglspb, $seksi) values('$tanggalajucart', '$nospb')");


$idbarangs   	= $_POST['idbarang'];
$satuanajucarts  = $_POST['satuanajucart'];
$namabarcarts    = $_POST['namabarcart'];





$queryjumlah = '';
$queryidbarang = '';
$querysatuanajucart = '';
$querynamabarcart = '';


foreach ($jumlahs as $i => $jumlah) {
	$queryjumlah .= "$jumlahs[$i]|";
	$queryidbarang .= "$idbarangs[$i]|";
	$querysatuanajucart .= "$satuanajucarts[$i]|";
	$querynamabarcart .= "$namabarcarts[$i]|";
	
} 

$db = "INSERT INTO pengajuancart (`namapegcart`, `actioncart`, `seksiajucart`,`tanggalajucart`, `stockajucart`, `idbarangcart`, `satuanajucart`, `namabarcart`, `nospb`, `keperluan`, `catatan`, `pegawaipengajuan`, `nondpengajuan`) VALUES ";
$val = "('$namapegcart', '$actioncart', '$seksiajucart','$tanggalajucart', '".rtrim($queryjumlah, "|")."', '".rtrim($queryidbarang, "|")."',  '".rtrim($querysatuanajucart, "|")."', '".rtrim($querynamabarcart, "|")."',  '$notapengajuan', '$keperluan', '$catatan', '$pegawaipengajuan', '$nondpengajuan')";

$realqueries = $db.$val;

// echo $realqueries;

if (mysqli_query($conn,$realqueries)){
		unset($_SESSION['cart']);
        // require_once "../../PHPMailer/class.phpmailer.php";
        // $mail = new PHPMailer;
        // //Enable SMTP debugging. 
        // $mail->SMTPDebug = 0;                               
        // $mail->isSMTP();                                
        // $mail->Host = "smtp.hostinger.com";
        // $mail->SMTPAuth = true;                          
        // $mail->SMTPSecure = "ssl";                           
        // $mail->Port = 465;
        // $mail->Username = "email";                 
        // $mail->Password = "password email"; 
        // //(dari) email dan nama pengirim 
        // $mail->From = "rt@beacukaiatambua.com";
        // $mail->FromName = "RT BC Atambua";
        // //(ke) email penerima 
        // $mail->addAddress("bcatambuart@gmail.com");

        // $mail->isHTML(true);
        // $mail->Subject = "Pengajuan Barang";
        // $pesanemail = "Mohon izin menyampaikan.\nNama : ".$namapegcart."\nSeksi : ".$seksiajucart."\nKeperluan : ".$keperluan."\nTelah mengajukan permohonan permintaan barang pada APASA V2, tanggal ".$tanggalajucart.", Dimohon segera ditindaklanjuti, terimakasih.";

        // $mail->Body = nl2br($pesanemail);
        // $mail->send();
	 ?>
        <script type="text/javascript">     
            alert   ("Data berhasil diajukan");
            window.location.href="../../index.php?page=keranjang";
        </script>
    <?php

}else{

} 
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