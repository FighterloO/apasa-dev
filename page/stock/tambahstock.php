<!-- sudah diupdate -->

<?php 
if ($akses == "ADMINPDAD" || $akses == "Admin" || $akses == "KSBU") {
 ?>

<!-- Textual inputs start -->
<br>
<div class="col-lg-12">
    <div class="card">
        <div class="card-body">
    <p><h1 align="center" class="font-weight-bold text-dark">TAMBAH BARANG</h1></p>
        </div>
    </div>
</div>

<form method="post" action="" enctype="multipart/form-data">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="header-title">Input Jenis Barang</h4>
                                       
                <div class="form-group">
                    <label for="example-text-input" class="col-form-label">Nama Barang</label>
                    <input class="form-control" type="text" name="namabar" onkeyup="this.value = this.value.toUpperCase()" required>
                </div>
                <div class="form-group">
                    <label for="example-search-input" class="col-form-label">Kode Barang</label>
                    <input class="form-control" type="textbox" name="idbarang" required>
                </div>
                <div class="form-group">
                    <label for="example-search-input" class="col-form-label">Deskripsi</label>
                    <input class="form-control" type="textbox" name="deskripsi" required>
                </div>
                <div class="form-group">
                    <label for="example-tel-input" class="col-form-label">Stock Awal</label>
                    <input class="form-control" type="number" name="stock" value="0" required>
                </div> 
                <div class="form-group">
                    <label for="example-email-input" class="col-form-label">Satuan</label>
                    <select class="form-control" name="satuan" required>
                          <option selected disabled></option>
                      <?php 
                      $queryjenissatuan = mysqli_query($conn, "SELECT * FROM datasatuan");
                      while ($datajenissatuan=$queryjenissatuan->fetch_assoc()) {
                      ?>
                          <option value="<?php echo $datajenissatuan['satuanbarang']; ?>"><?php echo $datajenissatuan['satuanbarang']; ?></option>
                      <?php
                        }                     
                      ?>
       
                    </select>
                </div>
                <div class="form-group">
                    <label for="example-url-input" class="col-form-label">Foto</label>
                    <input class="form-control" type="file" name="foto" required>
                </div>
                <br>
                <div class="form-group" align="center">
                    <button class="btn btn-danger" style="width: 50%;" type="submit" name="submit" value="submit">Submit</button>
                </div>
                                         
            </div>
        </div>
    </div>
</form>


                            <!-- Textual inputs end -->


<?php 
}else{

?>
     <script type="text/javascript">
        alert   ("Akses dilarang");
        window.location.href="?page=dashboard";

     </script>
    <?php
}

include 'acakangka.php';


if (isset($_POST["submit"])) {
    $namabar = $_POST['namabar'];
    $deskripsi = $_POST['deskripsi'];
    $idbarang = $_POST['idbarang'];
    $stock = $_POST['stock'];
    $satuan = $_POST['satuan'];
    $file = $_FILES['foto']['name'];
    $tmp_dir = $_FILES['foto']['tmp_name'];
    $fsize = $_FILES['foto']['size'];


    $querydatabarang = $conn->query("select * from databarang where idbarang ='$idbarang'");
    $tampildatabarang = $querydatabarang->fetch_assoc();

    if (isset($tampildatabarang) == true) {
        ?>
            <script type="text/javascript">     
                alert   ("Id Barang sudah digunakan");
                window.location.href="?page=tambahstock";
            </script>
        <?php   
    }else{   

    $namafoto = acakangkahuruf(10);
    $direktori='imgbarang/'; //path tempat simpan
    $ektensi=strtolower(pathinfo($file, PATHINFO_EXTENSION));
    $valid_ektensi=array('jpeg','jpg','png','jfif');
    $gambar=$namafoto.".".$ektensi;

    if(in_array($ektensi, $valid_ektensi)){
        if($fsize < 500*1024) {
            move_uploaded_file($tmp_dir, $direktori.$gambar);

            // hidden input
            $tglbarang = date('Y-m-d H:i:s');

            include "phpqrcode/qrlib.php";
            $tempdir = "temp/";
            if (!file_exists($tempdir))
                mkdir($tempdir);
                                
            $namakode = "rt-".$idbarang.".png";
            $quality = "M";
            $ukuran = 5;
            $padding = 2;

            QRcode::png($idbarang, $tempdir.$namakode,$quality,$ukuran,$padding);

            // input setiap perubahan data kedalam log masuk
            $inputlogmasuk = $conn->query("insert into log_masuk (namabarin, idbarangin, tglmasuk, satuanin, namapeg, stockin) values('$namabar', '$idbarang', '$tglbarang', '$satuan', '$get', '$stock')");
            // input kedalam stock db barang
            $sql = $conn->query("insert into databarang (namabar, deskripsi, stock, satuan, foto, tglbarang, idbarang) values('$namabar', '$deskripsi', '$stock', '$satuan', '$gambar', '$tglbarang', '$idbarang')");
            if ($sql) {
                ?>
                    <script type="text/javascript">     
                        alert   ("Data Barang Berhasil Tersimpan");
                        window.location.href="?page=tambahstock";
                    </script>
                 <?php 
              }
       }else{
                ?>
                    <script type="text/javascript">     
                        alert   ("Ukuran File terlalu besar");
                        window.location.href="?page=tambahstock";
                    </script>
                 <?php            
       }
    }else{
                ?>
                    <script type="text/javascript">     
                        alert   ("Ekstensi File yang benar ('jpeg','jpg','png','jfif')");
                        window.location.href="?page=tambahstock";
                    </script>
                 <?php            
       }
    }
}


 ?>