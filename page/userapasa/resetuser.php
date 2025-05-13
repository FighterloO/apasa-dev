<?php 
if ($akses !== "ADMINPDAD") {
	?>
	<script type="text/javascript">
	    alert   ("Akses dilarang");
	    window.location.href="?page=dashboard";
	</script>
	<?php
}else{
	$idreset = $_GET['id'];
	$resetpasswordhash = password_hash($resetpassword, PASSWORD_DEFAULT);
	$sql = $conn->query("update datauser set password='$resetpasswordhash' where noID = '$idreset'");
			if ($sql) {
				?>
					<script type="text/javascript">					
						alert	("Password Berhasil Direset");
						window.location.href="?page=datauser";
					</script>
				 <?php 
				}

}
?>