<?php 

    $_SESSION["pageno"] = $_GET["pageno"];
    $pagesekarang = $_SESSION["pageno"];  

?>
       <script type="text/javascript">
            window.location.href="?page=stockbarang&pageno=<?php echo$pagesekarang; ?>";
        </script>