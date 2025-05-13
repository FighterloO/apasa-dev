<br>
<div class="col-md-12">
  
    <div class="card">
        <div class="card-body">
            <p><h1 align="center" class="font-weight-bold text-dark">KERANJANG</h1></p>
        </div>
    


                    <?php             
                    if (!empty($_SESSION['cart'])) {
                     ?> 
  <form method="post" action="page/cart/qrcart.php">
    <input  class="form-control" type="hidden" name="namaP" value ="<?php echo $get; ?>" required>
    <input  class="form-control" type="hidden" name="seksi" value ="<?php echo $seksi; ?>" required>
    <div class="main-content-inner">
        <div class="card-body">
                    <div class="table-responsive data-tables datatable-dark" >
                        <table class="table table-striped table-bordered table-hover">
                            <thead class="text-capitalize">
                                <tr>
                                    <th style="width: 20%;  text-align: center;">Foto</th>
                                    <th style="width: 40%;  text-align: center;">Nama Barang</th>
                                    <th style="width: 20%;  text-align: center;">Stok pada Gudang/Satuan</th>
                                    <th style="width: 10%;  text-align: center;">Jumlah</th>
                                    <th style="width: 10%;  text-align: center;">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                    <?php 
                                        foreach ($_SESSION['cart'] as $idcart => $jumlah) {
                                          
                                         $anjay11 = $conn->query("select * from databarang where noidb='$idcart'");
                    
                                         $pecah = $anjay11->fetch_assoc();
                                    ?>
                                    
                                    <tr>
                                        <td align="center"><img style="height: 70px; width: 70px;" src="imgbarang/<?php echo $pecah['foto']; ?>" alt="image"></td>
                                        <td align="center"><p style="font-size: 15px;" class="title"><b><?php $kalimat123 = $pecah['namabar']; $tampil_sebagian =substr($kalimat123, 0, 100); echo $tampil_sebagian; ?></b></p></td>
                                        <td align="center"><?php echo $pecah['stock']; ?> <?php echo $pecah['satuan']; ?></td>
                                        <td align="center"><input  class="form-control" type="number" name="jumlah[<?php echo $idcart; ?>]" min="1" max="<?php echo $pecah['stock']; ?>" value="1" required></td>
                                        <td align="center">
                                            <!-- hidden input -->
                                            <input  class="form-control" type="hidden" name="idbarang[<?php echo $idcart; ?>]" value ="<?php echo $pecah['idbarang']; ?>" required>
                                            <input  class="form-control" type="hidden" name="satuanajucart[<?php echo $idcart; ?>]" value ="<?php echo $pecah['satuan']; ?>" required>
                                            <input  class="form-control" type="hidden" name="namabarcart[<?php echo $idcart; ?>]" value ="<?php echo $pecah['namabar']; ?>" required>
                                            <input  class="form-control" type="hidden" name="hakakses" value ="<?php echo $akses; ?>" required>
                                            <a href="?page=hapuscart&id=<?php echo $idcart; ?>" class="btn btn-danger" ><i class="ti-trash"></i></a> 
                                        </td>
                                    </tr>
                                    
                                    <?php 
                                        }
                                    ?>
                              

                            </tbody>
                        </table>
                    </div>
        </div>
     <br><br>
    <label>Nomor Nota Dinas :</label>
    <input  class="form-control" type="text" name="nondpengajuan" placeholder="ND-1/KBC090201/2023" required>
    <br>
    <label>Nama Pegawai :</label>
    <input  class="form-control" type="text" name="pegawaipengajuan" placeholder="Contoh Nama Y Benar" required>
    <br>
    <label>Seksi/Unit/Posko hanggar :</label>
    <input  class="form-control" type="text" name="keperluan" placeholder="SEKSI PENGOLAHAN DATA DAN ADMINISTRASI DOKUMEN" required>
    <br>
    <label>Tambahkan Catatan :</label>
    <input  class="form-control" type="text" name="catatan" maxlength="100" required>
    <br>
    </div>
    <br>   
                <div align="center">
                  <button class="btn btn-primary" style="width: 50%;" type="submit" name="ajukan">Ajukan</button>
                </div>
                <br><br>
</form>                 
                    <?php
                }else{
                    ?>
                  <div class="col-lg-12 col-md-6 mt-5">
                  <div class="card card-bordered">
                  <img class="card-img-top img-fluid" src="assets/images/icon/123.png" alt="image">
                  </div>
                  </div>
                  <br><br>
                    <?php
                      }                
                     ?>
                

  </div>            
</div>

<script src="assets/js/jquery.min.js"></script>
<!-- script one click only -->
<script type="text/javascript">
    $('form').submit(function(){
        $(this).find('button[type=submit]').prop('disabled', true);
    });
</script>

