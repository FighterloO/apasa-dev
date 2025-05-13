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
    
      $file_name =  'Data Log Keluar APASA.csv';
      header("Content-Description: File Transfer");
      header("Content-Disposition: attachment; filename=$file_name");
      header("Content-Type: application/csv;");
      $file = fopen("php://output", "w");
      $header = array("Nama Barang", "ID Barang", "Tanggal Pengajuan", "Jumlah Stock", "Satuan","Nama Pemohon", "Nama Pegawai", "Tanggal Pengeluaran", "Waktu Penyelesaian");
      fputcsv($file, $header);

            $sql = $conn->query("select * from pengajuanqr where tanggalajuqr >= '$tglawal' and tanggalajuqr <= '$tglakhir' and actionqr = 'dikeluarkan' order by tanggalajuqr desc") or die($conn->error);
            
            $masuk = new DateTime($data['tanggalajuqr']); 
            $keluar = new DateTime($data['tglpengeluaran']);
            $diff = $keluar->diff($masuk);

            while ($data=$sql->fetch_assoc()){
                    
                    $masuk = new DateTime($data['tanggalajuqr']); 
                    $keluar = new DateTime($data['tglpengeluaran']);
                    $diff = $keluar->diff($masuk);
                    
                  $r = array();
                  $r[] = $data['namabarqr'];
                  $r[] = $data['idbarangqr'];
                  $r[] = $data['tanggalajuqr'];
                  $r[] = $data['stockajuqr'];
                  $r[] = $data['satuanajuqr'];
                  $r[] = $data['namapegqr'];
                  $r[] = $data['adminkeluar'];
                  $r[] = $data['tglpengeluaran'];
                  $r[] = $diff->format('%d Hari %h Jam %i Menit %s Detik');
                  
                  fputcsv($file, $r);
            } exit;
      
}

   
 ?>
