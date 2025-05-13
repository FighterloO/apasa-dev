 <!-- sudah diupdate -->
<?php 

if ($akses == "ADMINPDAD" || $akses == "KSBU") {


 ?><br>
<div class="col-md-12">
    <div class="card">

        <div class="card-body">
            <p><h1 align="center" class="font-weight-bold text-dark">TABEL PERSETUJUAN</h1></p>
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
                                    <th style="width: 18%;  text-align: center;" >Nomor Nota Dinas</th>
                                    <th style="width: 18%;  text-align: center;" >Nama User</th>
                                    <th style="width: 18%;  text-align: center;" >Nama Pemohon</th>
                                    <th style="width: 18%;  text-align: center;" >Seksi/Unit/Posko hanggar</th>
                                    <th style="width: 18%;  text-align: center;" >Tanggal Pengajuan</th>
                                    <th style="width: 5%;  text-align: center;" >Status</th>
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
                                  $sql = $conn->query("select * from pengajuancart where actioncart='diterima' order by tanggalajucart desc");

                                  while ($data=$sql->fetch_assoc()){
                                 ?>
                              <tr>
                                <td align="center"><?php echo $no++; ?></td>   
                                <td align="center"><?php echo $data['nondpengajuan']; ?></td>                            
                                <td align="center"><?php echo $data['namapegcart']; ?></td>
                                <td align="center"><?php echo $data['pegawaipengajuan']; ?></td>
                                <td align="center"><?php echo $data['keperluan']; ?></td>
                                <td align="center"><?php echo formatTanggal($data['tanggalajucart']); ?></td>
                                
                                <td align="center"> 
                                    <?php 
                                    $tabelanjay = $data['actioncart'];
                                    if ($tabelanjay == "diterima") {
                                    ?>
                                  <a href="?page=infopersetujuanbarang&id=<?php echo $data['idcart']; ?>" class="btn btn-primary" ><i class="ti-info"></i></a>
                                   <?php 
                                  } else{
                                    echo $data['actioncart'];
                                  }
                                    ?>
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
