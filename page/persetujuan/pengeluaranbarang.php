 <!-- sudah diupdate -->
<?php 

if ($akses == "ADMINPDAD" || $akses == "Admin" || $akses == "KSBU") {

 ?><br>
<div class="col-md-12">
    <div class="card">
        <div class="card-body">
            <p><h1 align="center" class="font-weight-bold text-dark">TABEL PENGELUARAN BARANG</h1></p>
        </div>
    </div>
        <div class="card">
            <div align="right" style="padding-right: 5%">
                <a 
                <?php  
                // cek apakah ada data yang perlu dikeluarkan
        $nyobacekdata = $conn->query("select * from pengajuanqr where actionqr = 'disetujui' order by tanggalajuqr desc");
        $querynyobacekdata=$nyobacekdata->fetch_assoc();
                    if (!isset($querynyobacekdata) == true) {
                        echo "href='#'";
                    }else{
                        echo "href='?page=prosespengeluaransemua'";
                    }
                ?>
                type="button" style="color:white;" class="btn btn-warning">Keluarkan Semua</a>
            </div>
            <div class="card-body">
                <h4 class="header-title">Data Pengajuan Barang</h4>
                
                    <div class="table-responsive data-tables datatable-dark" >

                        <table id="myTable" class="table table-striped table-bordered table-hover" >
                            <thead class="text-capitalize">
                                <tr>
                                    <th style="width: 3%;  text-align: center;" >No</th>
                                    <th style="width: 15%;  text-align: center;" >Nama Barang</th>
                                    <th style="width: 10%;  text-align: center;" >ID Barang</th>
                                    <th style="width: 8%;  text-align: center;" >Stock</th>
                                    <th style="width: 5%;  text-align: center;" >Satuan</th>
                                    <th style="width: 12%;  text-align: center;" >Nama Pemohon</th>
                                    <th style="width: 15%;  text-align: center;" >Seksi/Unit/Posko hanggar</th>
                                    <th style="width: 15%;  text-align: center;" >Tanggal Pengajuan</th>
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
                                  $sql = $conn->query("select * from pengajuanqr where actionqr = 'disetujui' order by tanggalajuqr desc");

                                  while ($data=$sql->fetch_assoc()){
                                 ?>
                              <tr>
                                <form method="get" action="page/persetujuan/prosespengeluaran.php">
                                <td align="center"><?php echo $no++; ?></td>
                                <td align="center"><?php echo $data['namabarqr']; ?></td>
                                <td align="center"><?php echo $data['idbarangqr']; ?></td>
                                <td align="center">                                   
                                    <input
                                     class="form-control" readonly style="width: 80px;" type="number" min="1" name="stockajuqr" value="<?php echo $data['stockajuqr']; ?>">
                                    <input class="form-control" type="hidden" name="idajuqr" value="<?php echo $data['idajuqr']; ?>">
                                    <input class="form-control" type="hidden" name="namapengaju" value="<?php echo $data['namapegqr']; ?>">
                                    <input class="form-control" type="hidden" name="idbarangqr" value="<?php echo $data['idbarangqr']; ?>">
                                    <input class="form-control" type="hidden" name="seksipengaju" value="<?php echo $data['seksiajuqr']; ?>">
                                    <input class="form-control" type="hidden" name="tanggalajuqr" value="<?php echo $data['tanggalajuqr']; ?>">           
                                </td>
                                <td align="center"><?php echo $data['satuanajuqr']; ?></td>
                                <td align="center"><?php echo $data['namapegqr']; ?></td>
                                <td align="center"><?php echo $data['seksiajuqr']; ?></td>
                                <td align="center"><?php echo formatTanggal($data['tanggalajuqr']); ?></td>
                                <!-- hidden input -->
                                <input  class="form-control" type="hidden" name="hakakses" value ="<?php echo $akses; ?>" required>
                                <!-- hidden input -->
                                <td align="center"> 
                                    <?php 
                                    $tabelanjay = $data['actionqr'];
                                    if ($tabelanjay == "disetujui") {
                                    ?>                                  
                                  <button type="submit" class="btn btn-primary">Keluarkan</button>
                                   <?php 
                                  }else {
                                    echo $data['actionqr'];
                                  }
                                    ?>
                                </td>
                                </form>                                      
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