<?php 


require "session.php";


// lets run it baby
$tglawal11 = $_POST['tgl_awal'];
$tglakhir11 = $_POST['tgl_akhir'];

$tglawal = $tglawal11." 00:00:00";
$tglakhir = $tglakhir11." 23:59:59";

if (!isset($tglawal11) == true || !isset($tglakhir11) == true || !isset($tglawal) == true || !isset($tglakhir) == true) {
        ?>
             <script type="text/javascript">
                alert   ("Data tidak valid");
                window.location.href="?page=dashboard";
             </script>
        <?php
        exit;
    }

if (isset($_POST['export'])) {
    
      $file_name =  'Data Log Masuk APASA.csv';
      header("Content-Description: File Transfer");
      header("Content-Disposition: attachment; filename=$file_name");
      header("Content-Type: application/csv;");
      $file = fopen("php://output", "w");
      $header = array("Nama Barang", "ID Barang", "Tanggal Pemasukan", "Jumlah Stock", "Satuan", "Nama Pegawai");
      fputcsv($file, $header);

            $sql = $conn->query("select * from log_masuk where tglmasuk >= '$tglawal' and tglmasuk <= '$tglakhir' order by tglmasuk desc") or die($conn->error);

            while ($data=$sql->fetch_assoc()){

                  $r = array();
                  $r[] = $data['namabarin'];
                  $r[] = $data['idbarangin'];
                  $r[] = $data['tglmasuk'];
                  $r[] = $data['stockin'];
                  $r[] = $data['satuanin'];
                  $r[] = $data['namapeg'];
                  
                  fputcsv($file, $r);
            } exit;
      
}

   
 ?>
