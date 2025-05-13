<!-- sudah diupdate -->
<?php 

if ($akses == "ADMINPDAD" || $akses == "Admin" || $akses == "KSBU") {
 ?><br>
<div class="col-lg-12">
    <div class="card">
        <div class="card-body">
    <p><h1 align="center" class="font-weight-bold text-dark">REPORT CSV</h1></p>
    <br>
    <p style="padding: 20px;">Setelah Data Terdownload, buka <a target="blank" href="https://convertio.co/id/csv-xls/">Convertio</a>, <a target="blank" href="https://www.aconvert.com/document/csv-to-xls/">A Convert</a>, atau <a target="blank" href="https://cloudconvert.com/csv-to-xls">Cloud Convert</a> untuk mengubah file csv menjadi file excel.</p>
        </div>
  <div class="main-content-inner">
        <div class="card-area">
            <div class="row">     
                 <div class="col-lg-6 col-md-6 mt-5">
                    <div class="card card-bordered">
                        <div class="card-header">
                           <p>Report Log Masuk CSV</p>
                        </div>
                        <div class="card-body">
                          <form action="reportlogmasuk.php" method="post" class="form-horizontal custom-form">
                            <label>Tgl Awal</label>
                            <input type="date" class="form-control datepicker" name="tgl_awal" required>
                            <br>
                            <label>Tgl Akhir</label>
                            <input type="date" class="form-control datepicker" name="tgl_akhir" required>
                            <br>
                             <div>
                              <button type="submit"  name="export" value="export" class="btn btn-primary" > Export </button>
                             </div>
                          </form>  
                        </div>
                    </div>
                 </div>

                 
            <div class="col-lg-6 col-md-6 mt-5">
                    <div class="card card-bordered">
                        <div class="card-header">
                           <p>Report Log Keluar CSV</p>
                        </div>
                        <div class="card-body">
                          <form action="reportpengajuan.php" method="post" class="form-horizontal custom-form">
                            <label>Tgl Awal</label>
                            <input type="date" class="form-control datepicker" name="tgl_awal" required>
                            <br>
                            <label>Tgl Akhir</label>
                            <input type="date" class="form-control datepicker" name="tgl_akhir" required>
                            <br>
                             <div>
                              <button type="submit"  name="export" value="export" class="btn btn-primary" > Export </button>
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