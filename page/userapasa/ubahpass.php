<!-- sudah diupdate -->

<?php 
if ($akses == "ADMINPDAD" || $akses == "Admin" || $akses == "KSBU" || $akses == "User") {

 ?>
<!-- Textual inputs start -->

<div class="col-lg-12 mt-2">
    <div class="card">
        <div class="card-body">
    <p><h1 align="center" class="font-weight-bold text-dark">UBAH PASSWORD</h1></p>
        </div>
    </div>
</div>

<form method="post" action="">
    <div class="col-12 mt-5">
        <div class="card">
            <div class="card-body">
                <h4 class="header-title">Ubah Password</h4>
                                       
                <div class="form-group">
                    <label for="example-text-input" class="col-form-label">Password Lama</label>
                    <input class="form-control" minlength="5" type="password" required name="passlama" >
                </div>
                <div class="form-group">
                    <label for="example-text-input" class="col-form-label">Password Baru</label>
                    <input class="form-control" minlength="5" type="password" required name="passbaru"  >
                </div>
                <div class="form-group">
                    <label for="example-text-input" class="col-form-label">Konfirmasi Password</label>
                    <input class="form-control" minlength="5" type="password" required name="konfirmpass" >
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
}else{

?>
     <script type="text/javascript">
        alert   ("Akses dilarang");
        window.location.href="?page=dashboard";
     </script>
    <?php
}

if (isset($_POST["submit"])) {

	$passlama = $_POST ['passlama'];
	$passbaru = $_POST ['passbaru'];
	$konfirmpass = $_POST ['konfirmpass'];

	$ppq = mysqli_query($conn, "select * from datauser where noID = '$bye'");
	$datapass = mysqli_fetch_assoc($ppq);
	$anjayyy = $datapass['password'];

	if (!password_verify($passlama, $anjayyy)) {
		?>
			<script type="text/javascript">	
				alert	("Password lama yang anda tulis salah!");
			</script>
		 <?php
	}else{
		if (password_verify($passbaru, $anjayyy)) {
		?>
			<script type="text/javascript">	
				alert	("Password baru tidak boleh sama dengan yang sebelumnya!");
			</script>
		 <?php
		}else{
			if ($passbaru != $konfirmpass) {
		?>
			<script type="text/javascript">	
				alert	("Masukkan konfirmasi password dengan benar!");
			</script>
		 <?php
		 	}else{	 		
		 	$passwordhash = password_hash($passbaru, PASSWORD_DEFAULT);
			$sql = $conn->query("update datauser set password='$passwordhash' where noID = '$bye'");
			if ($sql) {
				?>
					<script type="text/javascript">					
						alert	("Password Berhasil Diubah");
						window.location.href="logout.php";
					</script>
				 <?php 
				}
			}
		}
	}
}


 ?>