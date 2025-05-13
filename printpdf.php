<?php 

include "fpdf/fpdf.php";
require "session.php";

function formatspmb($date){
    // menggunakan class Datetime
    $datetime = DateTime::createFromFormat('Y-m-d H:i:s', $date);
    return $datetime->format('Y-m-d');
 }
 
function tgl_indo($tanggal){
	$bulan = array (
		1 =>   'Januari',
		'Februari',
		'Maret',
		'April',
		'Mei',
		'Juni',
		'Juli',
		'Agustus',
		'September',
		'Oktober',
		'November',
		'Desember'
	);
	$pecahkan = explode('-', $tanggal);
	
	// variabel pecahkan 0 = tahun
	// variabel pecahkan 1 = bulan
	// variabel pecahkan 2 = tanggal
 
	return $pecahkan[2] . ' ' . $bulan[ (int)$pecahkan[1] ] . ' ' . $pecahkan[0];
}

$id = $_GET['id'];
    if (!isset($id) == true) {
        ?>
             <script type="text/javascript">
                alert   ("Data tidak valid");
                window.location.href="?page=dashboard";
             </script>
        <?php
        exit;
    }
    
    $sql = $conn->query("select * from pengajuancart where idcart='$id'");
    $tampil = $sql->fetch_assoc();

    $tglpenerimaanbarang = $tampil['tanggalajucart'];


    $conn->query("update pengajuancart set actioncart='dikeluarkan' where idcart='$id'");

    $seksiii = $tampil['keperluan'];
    $ksbu = $tampil['pegawaipengajuan'];
    $pegawairt = $tampil['penguruscart'];
    $kepalakantor = $tampil['kkpegcart'];
    $nospmbapasa = $tampil['nospmb'];
    $nospb = $tampil['nondpengajuan'];
    $tanggalajucart = tgl_indo(formatspmb($tampil['tanggalajucart']));
    $tgladminqr = tgl_indo(formatspmb($tampil['tgladminqr']));

switch ($seksiii) {
    case 'PDAD':
        $seksiii = "Pengolahan Data dan Administrasi Dokumen";
        break;
    case 'UMUM':
        $seksiii = "Subbagian Umum";
        break;
    case 'KI':
        $seksiii = "Kepatuhan Internal";
        break;
    case 'PKC1':
        $seksiii = "Pelayanan Kepabeanan dan Cukai I";
        break;
    case 'PKC2':
       $seksiii = "Pelayanan Kepabeanan dan Cukai II";
        break;
    case 'PKC3':
       $seksiii = "Pelayanan Kepabeanan dan Cukai III";
        break;
    case 'PKC4':
       $seksiii = "Pelayanan Kepabeanan dan Cukai IV";
        break;
    case 'PKC5':
       $seksiii = "Pelayanan Kepabeanan dan Cukai V";
        break;
    case 'PKC6':
       $seksiii = "Pelayanan Kepabeanan dan Cukai VI";
        break;
    case 'PKC7':
       $seksiii = "Pelayanan Kepabeanan dan Cukai VII";
        break;
    case 'PKC8':
       $seksiii = "Pelayanan Kepabeanan dan Cukai VIII";
        break;
    case 'PKC9':
       $seksiii = "Pelayanan Kepabeanan dan Cukai IX";
        break;
    case 'PKC10':
       $seksiii = "Pelayanan Kepabeanan dan Cukai X";
        break;
    case 'P2':
        $seksiii = "Penindakan dan Penyidikan";
        break;
    case 'PLI':
        $seksiii = "Penyuluhan dan Layanan Informasi";
        break;
    case 'PERBEND':
        $seksiii = "Perbendaharaan";
        break;
    default:
        break;
}



//extending class fpdf
class pdf extends FPDF{
	function letak($gambar){
		//memasukkan gambar untuk header
		$this->Image($gambar,15,10,35,32);
		//menggeser posisi sekarang
	}
	function judul($teks1, $teks2, $teks3, $teks4, $teks5, $teks6, $teks7, $teks8){
		$this->Cell(25);
		$this->SetFont('Times','B','14');
		$this->Cell(0,5,$teks1,0,1,'C');

		$this->Cell(25);
		$this->SetFont('Times','B','11');
		$this->Cell(0,5,$teks2,0,1,'C');
		$this->Cell(25);
		$this->Cell(0,5,$teks3,0,1,'C');

		$this->Cell(25);
		$this->SetFont('Times','B','13');
		$this->Cell(0,5,$teks4,0,1,'C');
		$this->Cell(25);
		$this->Cell(0,5,$teks5,0,1,'C');

		$this->SetFont('Times','','8');
		$this->Cell(25);
		$this->Cell(0,3,$teks6,0,1,'C');
		$this->Cell(25);
		$this->Cell(0,3,$teks7,0,1,'C');
		$this->Cell(25);
		$this->Cell(0,3,$teks8,0,1,'C');

	}
	function garis(){
		$this->SetLineWidth(1);
		$this->Line(10,48,200,48);
	}
	function surat($nospmb){
		$this->Ln(10);
		$this->SetFont('Times','B','12');
		$this->Cell(0,5,'SURAT PERINTAH MENGELUARKAN BARANG',0,1,'C');


		$this->SetFont('Times','B','12');
		$this->Cell(0,5,'(SPMB)',0,1,'C');

	
		$this->SetFont('Times','B','12');
		$this->Cell(0,5,'Nomor: '.$nospmb,0,1,'C');
	}
	function dataspmb($seksi, $nospb){
		$this->Ln(8);
		
		$this->Cell(2);
		$this->SetFont('Times','',10);
		$this->Cell(1);
		$this->Cell(10,5,'Harap dikeluarkan barang tersebut di bawah ini untuk keperluan :',0,0,'L');
		$this->Cell(140);
		$this->Cell(2,5,'',0,0,'L');
		$this->Cell(3);
		$this->Cell(1,5," ",0,1,'L');
		
		
		$this->Cell(2);
		$this->SetFont('Times','',9);
		$this->Cell(1);
		$this->Cell(10,5,'Seksi / Posko Hanggar / Unit',0,0,'L');
		$this->Cell(40);
		$this->Cell(2,5,':',0,0,'L');
		$this->Cell(3);
		$this->Cell(1,5,$seksi,0,1,'L');

		$this->Cell(2);
		$this->Cell(1);
		$this->Cell(10,5,'Berdasarkan Nota Dinas Nomor',0,0,'L');
		$this->Cell(40);
		$this->Cell(2,5,':',0,0,'L');
		$this->Cell(3);
		$this->Cell(1,5,$nospb,0,1,'L');
		$this->Cell(15);

		$this->Ln(6);
		$this->SetFont('Times','B','9');
		$this->Cell(10,5,'Daftar Barang :',0,0,'L');
	}
	function headertable(){
		$this->Ln(6);
		$this->SetFont('Times','B',10);
		$this->SetLineWidth(0.2);
		$this->Cell(10,8,'No.',1,0,'C');
		$this->Cell(100,8,'Nama Barang',1,0,'C');
		$this->Cell(35,8,'Jumlah',1,0,'C');
		$this->Cell(45,8,'Kode Barang',1,0,'C');
		$this->Ln();

	}
	function datatable($tglpenerimaanbarang, $id){
		$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
		$this->SetFont('Times','',9);

		$stmt = $conn->query("select * from pengajuanqr where idpengajuancart='$id' and stockajuqr != 0");
		$cekcekdata = $stmt->fetch_assoc();
		if (!isset($cekcekdata) == true) {
			$no=1;
			$stmt12 = $conn->query("select * from pengajuanqr where tanggalajuqr='$tglpenerimaanbarang' and stockajuqr != 0");
			while($data12 = $stmt12->fetch_assoc()){
				$kalimat12312 = $data12['namabarqr']; 
				$tampil_sebagian12 =substr($kalimat12312, 0, 50);

				$this->SetFont('Times','',9);
				$this->SetLineWidth(0.2);
				$this->Cell(10,4,$no++,1,0,'C');
				$this->Cell(100,4," ".$tampil_sebagian12,1,0,'L');
				$this->Cell(35,4,$data12['stockajuqr']." ".$data12['satuanajuqr'],1,0,'C');
				$this->Cell(45,4,$data12['idbarangqr'],1,0,'C');
				$this->Ln();
			}
		}else{
			$no=1;
			$stmtelse = $conn->query("select * from pengajuanqr where idpengajuancart='$id' and stockajuqr != 0");
			while($dataelse = $stmtelse->fetch_assoc()){
				$kalimat123 = $dataelse['namabarqr']; 
				$tampil_sebagian =substr($kalimat123, 0, 50);

				$this->SetFont('Times','',9);
				$this->SetLineWidth(0.2);
				$this->Cell(10,4,$no++,1,0,'C');
				$this->Cell(100,4," ".$tampil_sebagian,1,0,'L');
				$this->Cell(35,4,$dataelse['stockajuqr']." ".$dataelse['satuanajuqr'],1,0,'C');
				$this->Cell(45,4,$dataelse['idbarangqr'],1,0,'C');
				$this->Ln();
			}
		}
	}
	function jarak24(){
		$this->Ln(0);
	}
	function jarak25(){
		$this->Ln(0);
	}
	function jarak26(){
		$this->Ln(0);
	}
	function jarak27(){
		$this->Ln(0);
	}
	function jarak28(){
		$this->Ln(36);
	}
	function jarak29(){
		$this->Ln(34);
	}
	function jarak30(){
		$this->Ln(33);
	}
	function jarak31(){
		$this->Ln(32);
	}
	function jarak32(){
		$this->Ln(31);
	}
	function jarak33(){
		$this->Ln(30);
	}
	function jarak34(){
		$this->Ln(12);
	}
	function jarak35(){
		$this->Ln(10);
	}
	function jarak36(){
		$this->Ln(8);
	}
	function jarak37(){
		$this->Ln(8);
	}
	function jarak38(){
		$this->Ln(8);
	}
	function jarak39(){
		$this->Ln(8);
	}
	function jarak40(){
		$this->Ln(8);
	}
	function jarak41(){
		$this->Ln(8);
	}
	function jarak42(){
		$this->Ln(0);
	}
	function ttd($tanggalajucart, $tgladminqr){
		$this->Ln(7);
		$this->SetFont('Times','',9);
		$this->SetLineWidth(0);
		$this->Cell(63,10,' Diterima : '.$tanggalajucart,0,0,'L');
		$this->Cell(68,10,' Dikeluarkan : '.$tgladminqr,0,0,'L');
		$this->Cell(60,10,' Atambua, '.$tgladminqr,0,0,'L');
	}
	function ttd2(){
		$this->Ln(5);
		$this->SetFont('Times','',9);
		$this->SetLineWidth(0);
		$this->Cell(63,10,' ',0,0,'L');
		$this->Cell(68,10,' Pejabat Pengurus Persediaan',0,0,'L');
		$this->Cell(60,10,' Kuasa Pengguna Barang',0,0,'L');
	}

	function ttd3(){
		$this->Ln(29);
		$this->SetFont('Times','',9);
		$this->SetTextColor(150,150,150);
		$this->SetLineWidth(0);
		$this->Cell(63,10,' Ditandatangani secara elektronik',0,0,'L');
		$this->Cell(68,10,' Ditandatangani secara elektronik',0,0,'L');
		$this->Cell(60,10,' Ditandatangani secara elektronik',0,0,'L');
	}
	// ganti nama pejabat
	function ttd4($pegawairt, $ksbu, $kepalakantor){
		$this->Ln(5);
		$this->SetFont('Times','',9);
		$this->SetTextColor(0,0,0);
		$this->SetLineWidth(0);
		$this->Cell(63,10, ' '.$ksbu,0,0,'L', false,"http://pejabat");
		$this->Cell(68,10, ' '.$pegawairt,0,0,'L', false, "http://pejabat");
		$this->Cell(60,10, ' '.$kepalakantor,0,0,'L', false, "http://pejabat");
	}

}
// jumlah row pertabel
$countsql = $conn->query("select * from pengajuanqr where idpengajuancart='$id' and stockajuqr != 0");
$fetchcountsql = $countsql->fetch_assoc();
if (!isset($fetchcountsql) == true) {
	$countsql1 = $conn->query("select * from pengajuanqr where tanggalajuqr='$tglpenerimaanbarang' and stockajuqr != 0");
	while ($countdata1=$countsql1->fetch_array()){
		$rowdata1[] = $countdata1;
		}
		$countdata = count($rowdata1);
}else{
	$countsql2 = $conn->query("select * from pengajuanqr where idpengajuancart='$id' and stockajuqr != 0");
	while ($countdata2=$countsql2->fetch_array()){
		$rowdata2[] = $countdata2;
		}
		$countdata = count($rowdata2);
}


//instantisasi objek
$pdf=new pdf();

//properti dokumen
$pdf->SetTitle('SPMB');
//Mulai dokumen
$pdf->AddPage('P', 'A4');
$pdf->letak('assets/images/icon/logosurat.png');

// UBAH KOP SURAT SPMB!!

$pdf->judul(
			$teksjudul1, 
			$teksjudul2,
			$teksjudul3,
			$teksjudul4,
			$teksjudul5,
			$teksjudul6,
			$teksjudul7,
			$teksjudul8
		);
$pdf->garis();
$pdf->surat($nospmbapasa);
$pdf->dataspmb($seksiii, $nospb);
$pdf->headertable();
$pdf->datatable($tglpenerimaanbarang, $id);

if ($countdata == 24) {
	$pdf->jarak24();
}elseif ($countdata == 25) {
	$pdf->jarak25();
}elseif ($countdata == 26) {
	$pdf->jarak26();
}elseif ($countdata == 27) {
	$pdf->jarak27();
}elseif ($countdata == 28) {
	$pdf->jarak28();
}elseif ($countdata == 29) {
	$pdf->jarak29();
}elseif ($countdata == 30) {
	$pdf->jarak30();
}elseif ($countdata == 31) {
	$pdf->jarak31();
}elseif ($countdata == 32) {
	$pdf->jarak32();
}elseif ($countdata == 33) {
	$pdf->jarak33();
}elseif ($countdata == 34) {
	$pdf->jarak34();
}elseif ($countdata == 35) {
	$pdf->jarak35();
}elseif ($countdata == 36) {
	$pdf->jarak36();
}elseif ($countdata == 37) {
	$pdf->jarak37();
}elseif ($countdata == 38) {
	$pdf->jarak38();
}elseif ($countdata == 39) {
	$pdf->jarak39();
}elseif ($countdata == 40) {
	$pdf->jarak40();
}elseif ($countdata == 41) {
	$pdf->jarak41();
}elseif ($countdata == 42) {
	$pdf->jarak42();
}else{

}

$pdf->ttd($tanggalajucart, $tgladminqr);
$pdf->ttd2();
$pdf->ttd3();
$pdf->ttd4($pegawairt, $ksbu, $kepalakantor);
$pdf->Output($nospmbapasa.'.pdf','I');

 ?>