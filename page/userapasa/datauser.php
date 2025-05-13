<!-- sudah diupdate -->
<?php 

if ($akses !== "ADMINPDAD") {
    ?>
     <script type="text/javascript">
        alert   ("Akses dilarang");
        window.location.href="?page=dashboard";

     </script>
    <?php
}else{



 ?><br>
<div class="col-md-12">
    <div class="card">
        <div class="card-body">
            <p><h1 align="center" class="font-weight-bold text-dark">DATAUSER</h1></p>
        </div>
    </div>
        <div class="card">
            <div class="card-body">
                <h4 class="header-title">Tabel Datauser</h4>
                    <div class="table-responsive data-tables datatable-dark" >
                        <table id="myTable" class="table table-striped table-bordered table-hover" >
                            <thead class="text-capitalize">
                                <tr>
                                    <th style="width: 2%;  text-align: center;" >No</th>
                                    <th style="width: 20%;  text-align: center;" >Nama Pegawai</th>
                                    <th style="width: 15%;  text-align: center;" >NIP Peagawai</th>
                                    <th style="width: 15%;  text-align: center;" >Pangkat/Golongan</th>
                                    <th style="width: 10%;  text-align: center;" >Seksi</th>
                                    <th style="width: 10%;  text-align: center;" >Hak Akses</th>
                                    <th style="width: 30%;  text-align: center;" >Aksi</th>
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
                                  $sql = $conn->query("select * from datauser");

                                  while ($data=$sql->fetch_assoc()){
                                 ?>
                              <tr>
                                <td align="center"><?php echo $no++; ?></td>
                                <td align="center"><?php echo $data['nama']; ?></td>
                                <td align="center"><?php echo $data['nip']; ?></td>
                                <td align="center"><?php echo $data['pangkat']."/". $data['gol']; ?></td>
                                <td align="center"><?php echo $data['seksi']; ?></td>
                                <td align="center"><?php echo $data['hakakses']; ?></td>
                                <td class="22%" align="center">
                              <a href="?page=resetuser&id= <?php echo $data['noID']; ?>" class="btn btn-warning">Reset</a>
                              <a href="?page=ubahuser&id= <?php echo $data['noID']; ?>" class="btn btn-info">Ubah</a>
                              
                              </tr>

                              <?php } ?>        
                              

                            </tbody>
                        </table>
                    </div>
                           
                    <!-- Dark table end -->                                                 
            </div>
        </div>
</div>

<?php 
}

 ?>