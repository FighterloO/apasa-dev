<!-- sudah diupdate -->
<?php 
if ($akses == "ADMINPDAD" || $akses == "Admin" || $akses == "KSBU") {
    
 ?>

<br>
<div class="col-md-12">
    <div class="card">
        <div class="card-body">
            <p><h1 align="center" class="font-weight-bold text-dark">LOG PEMASUKAN BARANG</h1></p>
        </div>
    </div>
        <div class="card">
            <div class="card-body">
                <h4 class="header-title">Data Pemasukan Barang (Maks. 300 Entries Terbaru)</h4>
                    <div class="table-responsive data-tables datatable-dark" >
                        <table id="myTable" class="table table-striped table-bordered table-hover" >
                            <thead class="text-capitalize">
                                <tr>
                                    <th style="width: 5%;  text-align: center;" >No</th>
                                    <th style="width: 25%;  text-align: center;" >Nama Barang</th>
                                    <th style="width: 15%;  text-align: center;" >ID Barang</th>
                                    <th style="width: 15%;  text-align: center;" >Stock</th>
                                    <th style="width: 20%;  text-align: center;" >Nama Pegawai</th>
                                    <th style="width: 25%;  text-align: center;" >Tanggal Pemasukan</th>
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
                                  $sql = $conn->query("select * from log_masuk order by tglmasuk desc limit 300");

                                  while ($data=$sql->fetch_assoc()){
                                 ?>
                              <tr>
                                <td align="center"><?php echo $no++; ?></td>
                                <td align="center"><?php echo $data['namabarin']; ?></td>
                                <td align="center"><?php echo $data['idbarangin']; ?></td>
                                <td align="center"><?php echo $data['stockin']; ?></td>
                                <td align="center"><?php echo $data['namapeg']; ?></td>
                                <td align="center"><?php echo formatTanggal($data['tglmasuk']); ?></td>
                               
                              <?php } ?>        
                              </tr>

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