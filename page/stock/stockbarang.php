<!-- sudah diupdate -->

<br>
<div class="col-lg-12">
    <div class="card">
        <div class="card-body">
    <p><h1 align="center" class="font-weight-bold text-dark">STOK BARANG</h1></p>
        </div>
    </div>
</div>

    <!-- Nav Pills -->
    <!--<div class="col-xl-12 col-lg-6 mt-5">-->
        
    <!--    <div class="card">-->
    <!--        <div class="card-body">-->
    <!--            <h5>Grid/Table</h5>-->
    <!--            <br>-->
    <!--        <form action="?page=hapuslayout" method="post">-->
    <!--            <input type="hidden" name="layoutstock" value="grid">-->
    <!--            <input class="btn btn-default" style="float: left; margin: 5px;" name="ubahlayout" type="submit" value="Grid">-->
    <!--        </form>-->
    <!--        <form action="?page=stockbarang" method="post">-->
    <!--            <input type="hidden" name="layoutstock" value="tabel">-->
    <!--            <input class="btn btn-primary active" style="float: left; margin: 5px;" name="ubahlayout" type="submit" value="Table">-->
    <!--        </form>-->
    <!--        </div>-->
    <!--   </div>-->
    <!--</div>                          -->

     <div class="col-xl-12 col-lg-6 mt-5">
        <div class="card">
                <div class="card-body">
                <h4 class="header-title">Tabel Barang</h4>
                    <div class="table-responsive data-tables datatable-dark" >
                        <table id="myTable" class="table table-striped table-bordered table-hover">
                            <thead class="text-capitalize">
                                <tr>
                                    <th style="width: 2%;  text-align: center;" >No</th>
                                    <th style="width: 8%;  text-align: center;" >Foto</th>
                                    <th style="width: 20%;  text-align: center;" >Nama Barang</th>
                                    <th style="width: 15%;  text-align: center;" >Id Barang</th>
                                    <th style="width: 10%;  text-align: center;" >Stock/Satuan</th>
                                    <th style="width: 15%;  text-align: center;" >Terakhir Update</th>
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
                                  $sql = $conn->query("select * from databarang ORDER by namabar ASC");

                                  while ($data=$sql->fetch_assoc()){
                                 ?>
                              <tr>
                                <td align="center"><?php echo $no++; ?></td>
                                <td align="center"><img src="imgbarang/<?php echo $data['foto']; ?>" style="width: 50px; height: 50px;"></td>
                                <td align="center"><?php echo $data['namabar']; ?></td>
                                <td align="center"><?php echo $data['idbarang']; ?></td>
                                <td align="center"><?php echo $data['stock']."/". $data['satuan']; ?></td>
                                <td align="center"><?php echo formatTanggal($data['tglbarang']); ?></td>
                                <td align="center">
                                    <a class="btn btn-warning" href="?page=infobarang&id=<?php echo $data['noidb'];?>"><i class="ti-info"></i></a>
                                    <button type="button" class="btn btn-success" id"add_cart" onclick="yourFunction('<?php echo $data['noidb'];?>')"><i class="ti-shopping-cart"></i></button>
                                        <?php 
                                            if ($akses == "ADMINPDAD" || $akses == "Admin" || $akses == "KSBU") {  
                                        ?>
                                        <a class="btn btn-info" href="?page=ubahbarang&id=<?php echo $data['noidb'];?>"><i class="fa fa-edit"></i></a>                                            
                                        <a class="btn btn-danger" onclick="return confirm('konfirmasi hapus');" href="?page=deletebarang&id=<?php echo $data['noidb'];?>"><i class="ti-trash"></i></a>
                                        <?php 
                                            }
                                        ?>
                                </td>
                              </tr>

                              <?php } ?>        
                              

                            </tbody>
                        </table>
                    </div>
                           
                    <!-- Dark table end -->                                                 

            </div>
        </div>
    </div>
    

<a href="#" class="ignielToTop"></a>
        <!-- main content area end -->