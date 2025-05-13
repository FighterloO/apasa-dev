<?php 

session_start();
require_once "config.php";

if(!isset($_SESSION["haudwa7afgur2itgr72rqifagflgfaofoa3filflafnb3libs"])) {
	header("location: login.php");
	exit;
	}else{
		$randomstringapasav2 = $_SESSION["haudwa7afgur2itgr72rqifagflgfaofoa3filflafnb3libs"];
		$tanggallogin = date("Y/m/d");
		$sqlloginapasav2 = mysqli_query($conn, "SELECT * FROM datalogin WHERE tglaktiflogin = '$tanggallogin' and randomstringapasav2 = '$randomstringapasav2'"); 

    	if (mysqli_num_rows($sqlloginapasav2) < 1) {
    		?>
                <script type="text/javascript">
                    alert   ("Authentikasi Bermasalah");
                    window.location.href="login.php";
                </script>
            <?php
    	}
	}

 ?>