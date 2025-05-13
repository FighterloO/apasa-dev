<?php 

if ($akses == "Admin" || $akses == "KSBU") {

	$tglkeluar = date('Y-m-d H:i:s');     
   	$adminqr = $_SESSION['nama'];
	$datapengajuanqr = $conn->query("select * from pengajuanqr where actionqr ='disetujui'");

	$nyobadatapengajuanqr = $datapengajuanqr->fetch_assoc();
	if (isset($nyobadatapengajuanqr) == true) {
	

	while ($tampildatapengajuanqr = $datapengajuanqr->fetch_assoc()) {
		$idbarangqr = $tampildatapengajuanqr["idbarangqr"];
		$stockajuqr = $tampildatapengajuanqr["stockajuqr"];
		$idajuqr = $tampildatapengajuanqr["idajuqr"];
		$querydatabarang = $conn->query("select * from databarang where idbarang ='$idbarangqr'");
		$datastocklama = $querydatabarang->fetch_assoc();
		$stocklama = $datastocklama['stock'];
		if ($stocklama < $stockajuqr) {
			?>
               <script type="text/javascript">     
                alert   ("Barang yang disetujui melebihi stock");
                window.location.href="index.php?page=pengeluaranbarang";
               </script>
            <?php
		}else{

			$stockbaru = $stocklama - $stockajuqr;

				$updateajuqr = $conn->query("update pengajuanqr set actionqr='dikeluarkan', adminkeluar='$adminqr', tglpengeluaran='$tglkeluar' where idajuqr='$idajuqr'");

       			$updatestock = $conn->query("update databarang set stock='$stockbaru', tglbarang='$tglkeluar' where idbarang='$idbarangqr'");

       			?>
                    <script type="text/javascript">     
                        alert   ("Barang dikeluarkan");
                    </script>
                 <?php
		}

	}
				?>
                    <script type="text/javascript">     
                        alert   ("Semua barang telah dikeluarkan");
                        window.location.href="index.php?page=pengeluaranbarang";
                    </script>
                <?php 
	}else{
				?>
                    <script type="text/javascript">     
                        alert   ("Tidak ada barang yang perlu dikeluarkan");
                        window.location.href="index.php?page=pengeluaranbarang";
                    </script>
                <?php
	}
                
}else{
?>
     <script type="text/javascript">
        alert   ("Akses dilarang");
        window.location.href="index.php?page=dashboard";

     </script>
    <?php
} 
?>