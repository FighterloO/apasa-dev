<!-- sudah diupdate -->
<?php 

if ($akses == "ADMINPDAD" || $akses == "Admin" || $akses == "KSBU") {

if(!isset($_SESSION["filterterima"])) {

  ?>
 <script type="text/javascript">
    window.location.href="?page=filterallcp";
 </script>

  <?php 
  }

$tglawal2 = $_SESSION['tgl_awal2'];
$tglakhir2 = $_SESSION['tgl_akhir2'];
$filtertempat = $_SESSION['filtertempat'];

$tglawalfix = $tglawal2." 00:00:00";
$tglakhirfix = $tglakhir2." 23:59:59";




 ?><br>
<div class="col-md-12">
    <div class="card">

        <div class="card-body">
            <div class="form-group" align="right">
              <a class="btn btn-warning" href="?page=clearfilterallcp">Clear Filter</a>
            </div>
        <br>
            <p><h1 align="center" class="font-weight-bold text-dark">NOTA PENGAJUAN BARANG</h1></p>
        </div>
    </div>
        <div class="card">
            <div class="card-body">
                <h4 class="header-title">Data Pengajuan Barang</h4>
                    <div class="table-responsive data-tables datatable-dark" >
                        <table id="myTable" class="table table-striped table-bordered table-hover" >
                            <thead class="text-capitalize">
                                <tr>
                                    <th style="width: 5%;  text-align: center;" >No</th>
                                    <th style="width: 20%;  text-align: center;" >Nomor Nota Dinas</th>
                                    <th style="width: 20%;  text-align: center;" >Nama Pemohon</th>
                                    <th style="width: 15%;  text-align: center;" >Seksi/Unit/Posko hanggar</th>
                                    <th style="width: 20%;  text-align: center;" >Tanggal Pengajuan</th>
                                    <th style="width: 20%;  text-align: center;" >Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                function formatTanggal($date){
                                     // menggunakan class Datetime
                                     $datetime = DateTime::createFromFormat('Y-m-d H:i:s', $date);
                                     return $datetime->format('d-m-Y H:i:s');
                                    }

                                  $no =1;
                                  if ($filtertempat == "Semua") {
                                    $sql = $conn->query("select * from pengajuancart where tanggalajucart >= '$tglawalfix' and tanggalajucart <= '$tglakhirfix' order by tanggalajucart desc");
                                  }else{
                                    $sql = $conn->query("select * from pengajuancart where tanggalajucart >= '$tglawalfix' and tanggalajucart <= '$tglakhirfix' and keperluan = '$filtertempat' order by tanggalajucart desc");
                                  }

                                  while ($data=$sql->fetch_assoc()){
                                 ?>
                              <tr>
                                <td align="center"><?php echo $no++; ?></td> 
                                <td align="center"><?php echo $data['nondpengajuan']; ?></td>                              
                                <td align="center"><?php echo $data['pegawaipengajuan']; ?></td>
                                <td align="center"><?php echo $data['keperluan']; ?></td>
                                <td align="center"><?php echo formatTanggal($data['tanggalajucart']); ?></td>
                                
                                <td align="center"><a href="?page=infoallhistory&id=<?php echo $data['idcart']; ?>" class="btn btn-primary" ><i class="ti-info"></i></a>
                                </td>
                                      
                              </tr>
                              	<?php } ?> 
                            </tbody>
                        </table>
                    </div>
                    <br>     
                    <!-- Dark table end -->                                
                <div class="form-group" align="center">
                    <a class="btn btn-primary" href="?page=ubahsessionstockbarang">Lihat Stock Barang</a>
                </div>
                                         
            </div>
        </div>
</div>

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