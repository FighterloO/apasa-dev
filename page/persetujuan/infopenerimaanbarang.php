 <!-- sudah diupdate -->
 <?php 
if ($akses == "ADMINPDAD" || $akses == "Admin" || $akses == "KSBU") {

 function formatTanggal($date){
    // menggunakan class Datetime
    $datetime = DateTime::createFromFormat('Y-m-d', $date);
    return $datetime->format('d-m-Y');
 }
    $id = $_GET['id'];
    $sql = $conn->query("select * from pengajuancart where idcart='$id'");

    $tampil = $sql->fetch_assoc();
    $catatanque = $tampil['catatan'];  
                    

 ?>
  <div class="main-content-inner">
        <div class="card-area">
            <div class="row">     
                 <div class="col-lg-4 col-md-6 mt-5">
                    <div class="card card-bordered">
                            <div class="card-header">
                                <h5 class="title" align="center">Data Pemohon </h5>
                             </div>
                             <div class="card-body">
                                 
                                Nama User : <p style="color: blue;"><?php echo $tampil['namapegcart']; ?></p><br>
                                Nama Pemohon : <p style="color: blue;"><?php echo $tampil['pegawaipengajuan']; ?></p><br>
                                Tanggal Pengajuan : <p style="color: blue;"><?php echo $tampil['tanggalajucart']; ?></p><br>
                                Nomor Nota Dinas : <p style="color: blue;"><?php echo $tampil['nondpengajuan']; ?></p><br>
                                Seksi/Unit/Posko hanggar : <p style="color: blue;"><?php echo $tampil['keperluan']; ?></p><br>
                                <?php
                                    if (empty($catatanque)) {
                                        ?>
                                Catatan : <p style="color: blue;">-</p>
                                        <?php
                                     }else{
                                         ?>
                                Catatan : <p style="color: blue;"><?php echo $catatanque; ?></p>
                                        <?php 
                                     }
                                ?>
                            </div>
                    </div>
                 </div>

                 <div class="col-lg-8 col-md-6 mt-5">
                    <div class="card card-bordered">
                        <div class="card-header">
                            <h5 class="title" align="center">Data Barang </h5>
                        </div>
                        <div class="card-body"> 
                            <form method="post" action="page/persetujuan/prosespenerimaan.php">                          
                            <div class="table-responsive data-tables datatable-dark" >
                                <table class="table table-striped table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th style="width: 25%;  text-align: center;">ID Barang</th>
                                            <th style="width: 25%;  text-align: center;">Nama Barang</th>
                                            <th style="width: 25%;  text-align: center;">Stock</th>
                                            <th style="width: 25%;  text-align: center;">Satuan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                            $queryidbarang = $tampil['idbarangcart'];
                                            $querynamabarang = $tampil['namabarcart'];
                                            $querystockbarang = $tampil['stockajucart'];
                                            $querysatuanbarang = $tampil['satuanajucart'];

                                            $arrayidbarang = explode('|', $queryidbarang);
                                            $querynamabarang = explode('|', $querynamabarang);
                                            $querystockbarang = explode('|', $querystockbarang);
                                            $querysatuanbarang = explode('|', $querysatuanbarang);

                                            for ($i = 0; $i < count($arrayidbarang); $i++) {
                                                
                                            

                                         ?>
                                        <tr>
                                            <td style="text-align: center;"><?php echo $arrayidbarang[$i]; ?></td>
                                            <td style="text-align: center;"><?php echo $querynamabarang[$i]; ?></td>
                                <td style="text-align: center;">                                   
                                    <?php echo $querystockbarang[$i]; ?>
                                     <!-- hidden input -->
                                     <input  class="form-control" type="hidden" name="hakakses" value ="<?php echo $akses; ?>" required>
                                    <input class="form-control" type="hidden" name="idajucart[<?php echo $i; ?>]" value="<?php echo $id; ?>">
                                    <input class="form-control" type="hidden" name="idbarangout[<?php echo $i; ?>]" value="<?php echo $arrayidbarang[$i]; ?>">
                                    <input class="form-control" type="hidden" name="namabarout[<?php echo $i; ?>]" value="<?php echo $querynamabarang[$i]; ?>">
                                    <input class="form-control" type="hidden" name="satuanout[<?php echo $i; ?>]" value="<?php echo $querysatuanbarang[$i]; ?>">
                                    <input class="form-control" type="hidden" name="namapegout[<?php echo $i; ?>]" value="<?php echo $tampil['namapegcart']; ?>">
                                    <input class="form-control" type="hidden" name="seksiout[<?php echo $i; ?>]" value="<?php echo $tampil['seksiajucart']; ?>">
                                    <input class="form-control" type="hidden" name="tglkeluar[<?php echo $i; ?>]" value="<?php echo $tampil['tanggalajucart']; ?>">
                                    <!-- //hidden input -->         
                                </td>
                                            <td style="text-align: center;"><?php echo $querysatuanbarang[$i]; ?></td>
                                        </tr>
                                        <?php 
                                            }
                                         ?>
                                    </tbody>                                   
                                </table>                               
                            </div>
                            <div align="left">
                                Nama Pengurus Persediaan : 
                                <br>
                                <input class="form-control" type="text" name="penguruscart" required>
                                <br>
                                Nama Kepala Kantor :
                                <br>
                                <input class="form-control" type="text" name="kkpegcart" required>
                                <br>
                            </div>
                            <div align="center">
                                <button type="submit" class="btn btn-primary"><i class="ti-check"></i></button>
                                <a href="?page=tolakpenerimaanbarang&id=<?php echo $tampil['idcart']; ?>" class="btn btn-danger" onclick="return confirm('konfirmasi penolakan');"><i class="ti-close"></i></a> &emsp;
                                <a href="?page=penerimaanbarang" class="btn btn-warning"><i class=" ti-back-left"></i></a>
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
