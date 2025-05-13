<!-- sudah diupdate -->
<?php 

if ($akses == "ADMINPDAD" || $akses == "Admin" || $akses == "KSBU") {

if(!isset($_SESSION["filterspmb"])) {

  ?>
 <script type="text/javascript">
    window.location.href="?page=filterspmb";
 </script>

  <?php 
  }

$tglawal3 = $_SESSION['tgl_awal3'];
$tglakhir3 = $_SESSION['tgl_akhir3'];

$tglawalfix = $tglawal3." 00:00:00";
$tglakhirfix = $tglakhir3." 23:59:59";




 ?><br>
<div class="col-md-12">
    <div class="card">

        <div class="card-body">
            <div class="form-group" align="right">
              <a class="btn btn-warning" href="?page=clearfilterspmb">Clear Filter</a>
            </div>
            <p><h1 align="center" class="font-weight-bold text-dark">CETAK SPMB</h1></p>
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
                                    <th style="width: 30%;  text-align: center;" >Nomor Nota Dinas</th>
                                    <th style="width: 20%;  text-align: center;" >Nama Pemohon</th>
                                    <th style="width: 15%;  text-align: center;" >Seksi/Unit/Posko hanggar</th>
                                    <th style="width: 20%;  text-align: center;" >Tanggal Persetujuan</th>
                                    <th style="width: 10%;  text-align: center;" >Aksi</th>
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
                                  $sql = $conn->query("select * from pengajuancart where tgladminqr >= '$tglawalfix' and tgladminqr <= '$tglakhirfix' and (actioncart = 'disetujui' or actioncart = 'dikeluarkan') order by tgladminqr desc");


                                  while ($data=$sql->fetch_assoc()){
                                 ?>
                              <tr>
                                <td align="center"><?php echo $no++; ?></td> 
                                <td align="center"><?php echo $data['nondpengajuan']; ?></td>                              
                                <td align="center"><?php echo $data['pegawaipengajuan']; ?></td>
                                <td align="center"><?php echo $data['keperluan']; ?></td>
                                <td align="center"><?php echo formatTanggal($data['tgladminqr']); ?></td>
                                
                                <td align="center"><a href="printpdf.php?id=<?php echo $data['idcart']; ?>" class="btn btn-danger" ><i class="fa fa-print"></i></a>
                                </td>
                                      
                              </tr>
                              	<?php } ?> 
                            </tbody>
                        </table>
                    </div>
                    <br>     
                    <!-- Dark table end -->                                
                
                                         
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