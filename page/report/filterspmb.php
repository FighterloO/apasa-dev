<!-- sudah diupdate -->
<?php 
if ($akses == "ADMINPDAD" || $akses == "Admin" || $akses == "KSBU") {

if (isset($_POST['submit'])) { 

$_SESSION["filterspmb"] = true;
$_SESSION['tgl_awal3'] = $_POST['tgl_awal3'];
$_SESSION['tgl_akhir3'] = $_POST['tgl_akhir3'];


if(isset($_SESSION["filterspmb"])) {
  ?>
 <script type="text/javascript">
    window.location.href="?page=reportspmb";

 </script>

  <?php 
}

}


 ?>




<br>
<div class="col-lg-12">
    <div class="card">
        <div class="card-body">
    <p><h1 align="center" class="font-weight-bold text-dark">SURAT PERINTAH MENGELUARKAN BARANG</h1></p>   
        </div>
    


  <div class="main-content-inner">
        <div class="card-area">
            <div class="row">     
                 <div class="col-lg-12 col-md-6 mt-5">
                    <div class="card card-bordered">
                        <div class="card-header">
                             <p>Filter tanggal</p>
                        </div>
                        <div class="card-body"> 

                        <form action="" method="post" class="form-horizontal custom-form">
                          <div class="row">
                           <div class="col-lg-12" style="padding-left: 10%; padding-right: 10%; padding-top: 20px; padding-bottom: 20px;">
                            <div class="form-group">
                             <label>Tgl Awal</label>
                             <div class="input-group date">
                                 <input type="date" class="form-control datepicker" name="tgl_awal3" required>
                             </div>
                            </div>
                            <div class="form-group">
                             <label>Tgl Akhir</label>
                             <div class="input-group date">
                                 <input type="date" class="form-control datepicker" name="tgl_akhir3" required>
                             </div>
                            </div>
                            <button type="submit"  name="submit" value="submit" class="btn btn-default" > Cari Dokumen </button>
                           </div>
                           
                          </div>
                          </form>                           
                        </div>
                    </div>
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
 ?>


