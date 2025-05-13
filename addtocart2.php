<?php 
session_start();

if(!empty($_POST['id_barang'])){
  $idbarangkuy = stripslashes($_POST['id_barang']);
  if(empty($_SESSION['cart'][$idbarangkuy])){
     $_SESSION['cart'][$idbarangkuy] = true; 
     $data = 1;
  }else{
     $data = 2;
  }
}

//returns data as JSON format
echo json_encode($data);
 
?> 