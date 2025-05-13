<!-- sudah diupdate -->
<?php 

if(isset($_SESSION["layouttabel"])) {
    ?>
<script type="text/javascript">
        window.location.href="?page=stockbarang1";
</script>

    <?php
    }
?>

<br>
<div class="col-lg-12">
    <div class="card">
        <div class="card-body">
    <p><h1 align="center" class="font-weight-bold text-dark">STOK BARANG</h1></p>
        </div>
    </div>
</div>

    <!-- Nav Pills -->
    <div class="col-xl-12 col-lg-6 mt-5">
        
        <div class="card">
            <div class="card-body">
                <h5>Grid/Table</h5>
                <br>
            <form action="?page=stockbarang1" method="post">
                <input type="hidden" name="layoutstock" value="grid">
                <input class="btn btn-primary active" style="float: left; margin: 5px;" name="ubahlayout" type="submit" value="Grid">
            </form>
            <form action="?page=addlayout" method="post">
                <input type="hidden" name="layoutstock" value="tabel">
                <input class="btn btn-default" style="float: left; margin: 5px;" name="ubahlayout" type="submit" value="Table">
            </form>
            <br><br><br><br>
                <h5>Barang yang sering dicari</h5>
            <br>
            <form action="?page=stockbarang" method="post">
                <input type="hidden" name="cari" value="alattulis">
                <input class="btn btn-dark" style="float: left; margin: 5px;" type="submit" value="#alattulis">
            </form>
            <form action="?page=stockbarang" method="post">
                <input type="hidden" name="cari" value="pemotong">
                <input class="btn btn-dark" style="float: left; margin: 5px;" type="submit" value="#pemotong">
            </form>
            <form action="?page=stockbarang" method="post">
                <input type="hidden" name="cari" value="kertas">
                <input class="btn btn-dark" style="float: left; margin: 5px;" type="submit" value="#kertas">
            </form>
            <form action="?page=stockbarang" method="post">
                <input type="hidden" name="cari" value="obat">
                <input class="btn btn-dark" style="float: left; margin: 5px;" type="submit" value="#obat">
            </form>
            <form action="?page=stockbarang" method="post">
                <input type="hidden" name="cari" value="sabun">
                <input class="btn btn-dark" style="float: left; margin: 5px;" type="submit" value="#sabun">
            </form>
            <form action="?page=stockbarang" method="post">
                <input type="hidden" name="cari" value="tisu">
                <input class="btn btn-dark" style="float: left; margin: 5px;" type="submit" value="#tisu">
            </form>
            <form action="?page=stockbarang" method="post">
                <input type="hidden" name="cari" value="baterai">
                <input class="btn btn-dark" style="float: left; margin: 5px;" type="submit" value="#baterai">
            </form>
            </div>
       </div>
    </div>                          

     <div class="main-content-inner">
        <div class="card-area">
            <div class="row">
                <?php 
                    function formatTanggal($date){
                     // menggunakan class Datetime
                     $datetime = DateTime::createFromFormat('Y-m-d H:i:s', $date);
                     return $datetime->format('d-m-Y H:i:s');
                    }

                    // pagination start

                    if (isset($_GET['pageno'])) {
                        $pageno = $_GET['pageno'];
                    } else {
                        $pageno = 1;
                    }

                    $no_of_records_per_page = 148;
                    $offset = ($pageno-1) * $no_of_records_per_page;

                    $total_pages_sql = "SELECT COUNT(*) FROM databarang";
                    $result = mysqli_query($conn,$total_pages_sql);
                    $total_rows = mysqli_fetch_array($result)[0];
                    $total_pages = ceil($total_rows / $no_of_records_per_page); 


                    if(isset($_POST['cari'])){
                        $cari = $_POST['cari'];
                         $sql = $conn->query("select * from databarang where namabar like '%".$cari."%' OR idbarang LIKE '$cari' OR deskripsi LIKE '%".$cari."%' ORDER by namabar ASC LIMIT $offset, $no_of_records_per_page");             
                    }else{
                         $sql = $conn->query("select * from databarang ORDER by namabar ASC LIMIT $offset, $no_of_records_per_page");      
                    } 
                    
                    while ($data=$sql->fetch_assoc()){
                ?>
                    
                                <div class="col-lg-3 col-md-6 mt-5">
                                    <div class="card card-bordered">

                                        <img style="height: 200px; width: 200px; display: block; margin-top: 20px; margin-left: auto; margin-right: auto;" class="card-img-top img-fluid" src="imgbarang/<?php echo $data['foto']; ?>" alt="image">
                                        <div class="card-body">
                                            <div style="height: 60px;">
                                                <p style="font-size: 15px;" class="title"><b><?php $kalimat123 = $data['namabar']; $tampil_sebagian =substr($kalimat123, 0, 50); echo $tampil_sebagian; ?></b></p>
                                            </div>
                                                <p style="font-size: 13px;" class="card-text">
                                                    Stock : <?php echo $data['stock']; ?> <?php echo $data['satuan']; ?><br>
                                                    <?php 
                                                        if ($akses !== "User") {  
                                                    ?>
                                                    Kode Barang : <?php echo $data['idbarang']; ?><br>
                                                    <?php 
                                                        }
                                                    ?>
                                                    Terakhir Update:  <?php echo formatTanggal($data['tglbarang']); ?>
                                                </p>
                                            
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
                                        </div>
                                    </div>
                                </div>
                            

                <?php 
                    }
                ?>
            </div>
        </div>
    </div>
    
    <div align="center">
        <a class="btn btn-dark" href="?page=pindahhalaman&pageno=1"><<</a>
        <a class="btn btn-dark" <?php if($pageno <= 1){ echo 'disabled'; } ?> href="<?php if($pageno <= 1){ echo '#'; } else { echo "?page=pindahhalaman&pageno=".($pageno - 1); } ?>">Prev</a>
        <a class="btn btn-dark" <?php if($pageno >= $total_pages){ echo 'disabled'; } ?> href="<?php if($pageno >= $total_pages){ echo '#'; } else { echo "?page=pindahhalaman&pageno=".($pageno + 1); } ?>">Next</a>
        <a class="btn btn-dark" href="?page=pindahhalaman&pageno=<?php echo $total_pages; ?>">>></a>
    </div> <br>
      
<a href="#" class="ignielToTop"></a>
        <!-- main content area end -->