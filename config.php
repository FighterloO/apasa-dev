<?php 

// UBAH DB HOST

define ( 'DB_HOST', '' );

define ( 'DB_USER', '' );

define ( 'DB_PASSWORD', '' );

define ( 'DB_NAME', '' );

$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

// UBAH NAMA KEPALA KANTOR

$NamaKepalaKantorSekarang = "Rahmady Effendi Hutahaean";

// UBAH NOMOR KODE KANTOR

$KodeKantorBC = "/KBC.0902"; 

// UBAH KOP SURAT SPMB

$teksjudul1 = "KEMENTERIAN KEUANGAN REPUBLIK INDONESIA";
$teksjudul2 = "DIREKTORAT JENDERAL BEA DAN CUKAI";
$teksjudul3 = "KANTOR WILAYAH DJBC JAWA BARAT";
$teksjudul4 = "KANTOR PENGAWASAN DAN PELAYANAN BEA DAN CUKAI";
$teksjudul5 = "TIPE MADYA PABEAN A PURWAKARTA";
$teksjudul6 = "JALAN BUKIT AKASIA II, KOTA BUKIT INDAH, PURWAKARTA 41204";
$teksjudul7 = "TELEPON (0264) 351634, 350308; FAKSIMILE (0264) 351633; LAMAN www.djbcpurwakarta.com";
$teksjudul8 = "PUSAT KONTAK LAYANAN 1500225; SUREL info@customs.go.id";

// UBAH DATE TIME ZONE

date_default_timezone_set("Asia/Makassar");

// UBAH CONFIG PASSWORD

$resetpassword = 'PURWAKARTA123';

?>