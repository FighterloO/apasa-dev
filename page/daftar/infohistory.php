<!-- sudah diupdate -->
<?php 
  
 function formatTanggal($date){
    // menggunakan class Datetime
    $datetime = DateTime::createFromFormat('Y-m-d H:i:s', $date);
    return $datetime->format('d-m-Y H:i:s');
 }

 if ($akses == "ADMINPDAD" || $akses == "Admin" || $akses == "KSBU" || $akses == "User") {
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
                                <h5 class="title" align="center">Detail Nota Pengajuan Barang </h5>
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
                            <div class="table-responsive data-tables datatable-dark" >
                                <table id="myTable" class="table table-striped table-bordered table-hover">
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
                                            <td style="text-align: center;"><?php echo $querystockbarang[$i]; ?></td>
                                            <td style="text-align: center;"><?php echo $querysatuanbarang[$i]; ?></td>
                                        </tr>
                                        <?php 
                                            }
                                         ?>
                                    </tbody>                                   
                                </table>                               
                            </div>
                            <br>
                            <div align="center">
                                <a href="?page=catatanpengajuan" class="btn btn-warning">Kembali</i></a>
                            </div>
                        </div>
                    </div>
                 </div>
                 <br>
                 <div class="col-lg-12 col-md-6 mt-5">
                    <div class="card card-bordered">
                        <div class="card-header" align="center">
                            <b>Tracking Pengajuan</b>
                        </div>
                        <?php 
                        if ($tampil['actioncart'] == 'ajukan' ){
                        ?>
                        <div class="card-body" align="center">
                            <div class="row d-flex justify-content-center">
                                <div class="col-12">
                                    <ul id="progressbar" class="text-center">
                                        <li class="step0"><b><br>Pengajuan<br>Diajukan</b><br><br></li>
                                        <li class="step0"></li>
                                        <li class="step0"></li>
                                    </ul>
                                </div>
                            </div>                                                               
                        </div>
                        <?php 
                        }elseif ($tampil['actioncart'] == 'diterima') {
                         ?>
                        <div class="card-body" align="center">
                            <div class="row d-flex justify-content-center">
                                <div class="col-12">
                                    <ul id="progressbar" class="text-center">
                                        <li class="active step0"><b><br>Pengajuan<br>Diterima</b><br><br><i style="color: green;" class="ti-check"></i></li>
                                        <li class="step0"><b><br>Menunggu<br>Persetujuan</b></li>
                                        <li class="step0"></li>
                                    </ul>
                                </div>
                            </div>                                                               
                        </div>
                        <?php 
                        }elseif ($tampil['actioncart'] == 'tidak diterima') {
                         ?>
                         <div class="card-body" align="center">
                            <div class="row d-flex justify-content-center">
                                <div class="col-12">
                                    <ul id="progressbar" class="text-center">
                                        <li class="active step0"><b><br>Pengajuan<br>Tidak Diterima</b><br><br><i style="color: red;" class="ti-close"></i></li>
                                        <li class="step0"></li>
                                        <li class="step0"></li>
                                    </ul>
                                </div>
                            </div>                                                               
                        </div>
                         <?php 
                         }elseif ($tampil['actioncart'] == 'disetujui') {    
                         
                          ?>
                        <div class="card-body" align="center">
                            <div class="row d-flex justify-content-center">
                                <div class="col-12">
                                    <ul id="progressbar" class="text-center">
                                        <li class="active step0"><b><br>Pengajuan<br>Diterima</b><br><br><i style="color: green;" class="ti-check"></i></li>
                                        <li class="active step0"><b><br>Pengajuan<br>Disetujui</b><br><br><i style="color: green;" class="ti-check"></i></li>
                                        <li class="step0"><b><br>Menunggu<br>Pengeluaran</b></li>
                                    </ul>
                                </div>
                            </div>                                                               
                        </div>
                          <?php 
                        }elseif ($tampil['actioncart'] == 'ditolak') {    
                         
                          ?>
                        <div class="card-body" align="center">
                            <div class="row d-flex justify-content-center">
                                <div class="col-12">
                                    <ul id="progressbar" class="text-center">
                                        <li class="active step0"><b><br>Pengajuan<br>Diterima</b><br><br><i style="color: green;" class="ti-check"></i></li>
                                        <li class="active step0"><b><br>Pengajuan<br>Ditolak</b><br><br><i style="color: red;" class="ti-close"></i></li>
                                        <li class="step0"></li>
                                    </ul>
                                </div>
                            </div>                                                               
                        </div>
                          <?php 
                        }elseif ($tampil['actioncart'] == 'dikeluarkan') {    
                         
                          ?>
                        <div class="card-body" align="center">
                            <div class="row d-flex justify-content-center">
                                <div class="col-12">
                                    <ul id="progressbar" class="text-center">
                                        <li class="active step0"><b><br>Pengajuan<br>Diterima</b><br><br><i style="color: green;" class="ti-check"></i></li>
                                        <li class="active step0"><b><br>Pengajuan<br>Disetujui</b><br><br><i style="color: green;" class="ti-check"></i></li>
                                        <li class="active step0"><b><br>Barang<br>Dikeluarkan</b><br><br><i style="color: green;" class="ti-check"></i></li>
                                    </ul>
                                </div>
                            </div>                                                               
                        </div>
                          <?php 
                        }
                           ?>
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
 ?> 
    