<!-- sudah diupdate -->

 <?php 
 function formatTanggal($date){
    // menggunakan class Datetime
    $datetime = DateTime::createFromFormat('Y-m-d', $date);
    return $datetime->format('d-m-Y');
 }
    

if ($akses == "ADMINPDAD" || $akses == "Admin" || $akses == "KSBU") {
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
    $sql = $conn->query("select * from databarang where noidb='$id'");

    $tampil = $sql->fetch_assoc();
 ?>



    <div class="main-content-inner">
        <div class="card-area">
            <div class="row">     
                 <div class="col-lg-4 col-md-6 mt-5">
                    <div class="card card-bordered">
                        <img class="card-img-top img-fluid" src="imgbarang/<?php echo $tampil['foto']; ?>" alt="image">
                            <div class="card-body">
                                <h5 class="title" align="center"><?php echo $tampil['namabar']; ?></h5>
                             </div>
                    </div>
                 </div>

                 <div class="col-lg-8 col-md-6 mt-5">
                    <div class="card card-bordered">
                            <div class="card-body">
                                <form action="" method="post">
                                <h5 class="title">Ubah Barang :</h5>
                                    <div class="form-group">
                                        <label for="example-text-input" class="col-form-label">Nama Barang</label>
                                        <input class="form-control" type="text" name="namabar" onkeyup="this.value = this.value.toUpperCase()" value="<?php echo $tampil['namabar']; ?>" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="example-search-input" class="col-form-label">Kode Barang</label>
                                        <input class="form-control" type="textbox" readonly name="idbarang" value="<?php echo $tampil['idbarang']; ?>" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="example-search-input" class="col-form-label">Deskripsi</label>
                                        <input class="form-control" type="textbox" name="deskripsi" value="<?php echo $tampil['deskripsi']; ?>" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="example-tel-input" class="col-form-label">Stock yang ingin Ditambah</label>
                                        <input class="form-control" type="number" name="stock" value="0" required>
                                    </div> 
                                    <div class="form-group">
                                        <label for="example-email-input" class="col-form-label">Satuan</label>
                                        <select class="form-control" name="satuan" required>
                                          <?php 
                                            if (empty($tampil['satuan'])) {
                                              ?>
                                                <option selected disabled></option>
                                              <?php
                                            }else{
                                              ?>
                                                <option selected value='<?php echo $tampil['satuan']; ?>'><?php echo $tampil['satuan']; ?></option>";
                                              <?php
                                            }

                                          $querysatuanbarang = mysqli_query($conn, "SELECT * FROM datasatuan");
                                          while ($datasatuanbarang=$querysatuanbarang->fetch_assoc()) {
                                          ?>
                                              <option value="<?php echo $datasatuanbarang['satuanbarang']; ?>"><?php echo $datasatuanbarang['satuanbarang']; ?></option>
                                          <?php
                                            }                     
                                          ?>
                           
                                        </select>
                                    </div><br>
                                    <div align="center">
                                    <button class="btn btn-warning" type="submit" name="submit" value="submit">Ubah</button>
                                    <a href="?page=infobarang&id=<?php echo $tampil['noidb'];?>" class="btn btn-primary">Info Barang</a>
                                    <a href="?page=stockbarang" class="btn btn-danger">Kembali</a>
                                    </div>
                                    </form>
                             </div>
                    </div>
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

if (isset($_POST["submit"])) {
    $namabar = $_POST['namabar'];
    $deskripsi = $_POST['deskripsi'];
    $noidbarang = $_POST['idbarang'];
    $stock = $_POST['stock'];
    $satuan = $_POST['satuan'];
    $tglbarang = date('Y-m-d H:i:s');
    $stockawal = $tampil['stock'];
    $totalstock = $stockawal + $stock;

    // input setiap perubahan data kedalam log masuk
    $inputlogmasuk = $conn->query("insert into log_masuk (namabarin, idbarangin, tglmasuk, satuanin, namapeg, stockin) values('$namabar', '$noidbarang', '$tglbarang', '$satuan', '$get', '$stock')");
    // input kedalam stock db barang
    $sql = $conn->query("update databarang set namabar='$namabar', idbarang='$noidbarang', deskripsi='$deskripsi', stock='$totalstock', satuan='$satuan', tglbarang='$tglbarang' where noidb='$id'");
    if ($sql) {
        ?>
            <script type="text/javascript">                
                alert   ("Data Berhasil Diubah");
                window.location.href="?page=infobarang&id=<?php echo $tampil['noidb'];?>";
            </script>
         <?php 
    }
}


 ?>