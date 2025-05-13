<!-- sudah diupdate -->
<?php 
  
 function formatTanggal($date){
    // menggunakan class Datetime
    $datetime = DateTime::createFromFormat('Y-m-d H:i:s', $date);
    return $datetime->format('d-m-Y H:i:s');
 }
    $id = $_GET['id'];
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
                                <h5 class="title">Deskripsi Barang :</h5>
                                    <p class="card-text">
                                        <?php echo $tampil['deskripsi']; ?><br>
                                        Stock : <?php echo $tampil['stock']; ?> <?php echo $tampil['satuan']; ?><br>
                                        Terakhir Update:  <?php echo formatTanggal($tampil['tglbarang']); ?>
                                    </p>
                                    <div align="center">
                                    <?php 
                                        if ($akses == "ADMINPDAD" || $akses == "Admin" || $akses == "KSBU") {  
                                    ?>
                                    <a href="?page=ubahbarang&id=<?php echo $tampil['noidb'];?>" class="btn btn-primary">Edit Barang</a>
                                    <?php 
                                        }
                                    ?>
                                    <a href="?page=stockbarang" class="btn btn-danger">Kembali</a>
                                    </div>
                             </div>
                    </div>
                 </div>
            </div>
        </div>
    </div>