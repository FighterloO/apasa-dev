<!-- sudah diupdate -->
<?php 
if ($akses !== "ADMINPDAD") {
    ?>
     <script type="text/javascript">
        alert   ("Akses dilarang");
        window.location.href="?page=dashboard";

     </script>
    <?php
}else{
	$id	= $_GET['id'];
	$sql = $conn->query("select * from datauser where noID='$id'");

	$tampil = $sql->fetch_assoc();
 ?>


<!-- Textual inputs start -->

<div class="col-lg-12 mt-2">
    <div class="card">
        <div class="card-body">
    <p><h1 align="center" class="font-weight-bold text-dark">UBAH DATAUSER</h1></p>
        </div>
    </div>
</div>

<form method="post" action="">
    <div class="col-12 mt-5">
        <div class="card">
            <div class="card-body">
                <h4 class="header-title">Ubah Data</h4>
                                       
                <div class="form-group">
                    <label for="example-text-input" class="col-form-label">Nama Pegawai</label>
                    <input class="form-control" type="text" name="nama" value="<?php echo $tampil['nama']; ?>" required>
                </div>
                <div class="form-group">
                    <label for="example-text-input" class="col-form-label">NIP</label>
                    <input class="form-control" type="text" name="nip" value="<?php echo $tampil['nip']; ?>" required>
                </div>
                <div class="form-group">
                    <label for="example-text-input" class="col-form-label">Pangkat</label>
                    <input class="form-control" type="text" name="pangkat" value="<?php echo $tampil['pangkat']; ?>" required>
                </div>
                <div class="form-group">
                    <label for="example-text-input" class="col-form-label">Golongan</label>
                    <input class="form-control" type="text" name="gol" value="<?php echo $tampil['gol']; ?>" required>
                </div>
                <div class="form-group">
                    <label for="example-text-input" class="col-form-label">Hak Akses</label>
                    <select class="form-control" name="hakakses" required>
                        <option value="<?php echo $tampil['hakakses']; ?>">--</option>
                        <option value="User">User</option>
                        <option value="Admin">Admin RT</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="example-text-input" class="col-form-label">Seksi</label>
                    <select class="form-control" name="seksi" required>
                        <option value="<?php echo $tampil['seksi']; ?>">--</option>
                        <option value="UMUM">Subbagian Umum</option>
                        <option value="P2">P2</option>
                        <option value="PDAD">PDAD</option>
                        <option value="PKC1">PKC 1</option>
                        <option value="PKC2">PKC 2</option>
                        <option value="PKC3">PKC 3</option>
                        <option value="PKC4">PKC 4</option>
                        <option value="PKC5">PKC 5</option>
                        <option value="PKC6">PKC 6</option>
                        <option value="PKC7">PKC 7</option>
                        <option value="PKC8">PKC 8</option>
                        <option value="PKC9">PKC 9</option>
                        <option value="PKC10">PKC 10</option>
                        <option value="KI">KI</option>
                        <option value="PERBEND">Perbendaharaan</option>
                        <option value="PLI">PLI</option>
                    </select>
                </div>
                <br>
                <div class="form-group" align="center">
                    <button class="btn btn-danger" style="width: 50%;" type="submit" name="submit" value="submit">Submit</button>
                </div>
                                         
            </div>
        </div>
    </div>
</form>


             

<?php 
}

if (isset($_POST["submit"])) {

	$nama = $_POST ['nama'];
	$nip = $_POST ['nip'];
	$pangkat = $_POST ['pangkat'];
	$gol = $_POST ['gol'];
	$hakakses = $_POST ['hakakses'];
	$seksi = $_POST ['seksi'];

	$sql = $conn->query("update datauser set nama='$nama', nip='$nip', pangkat='$pangkat', gol='$gol', hakakses='$hakakses', seksi='$seksi' where noID='$id'");
	if ($sql) {
		?>
			<script type="text/javascript">
				
				alert	("Data Berhasil Diubah");
				window.location.href="?page=datauser";
			</script>
		 <?php 
	}
}


 ?>