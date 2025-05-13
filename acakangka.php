<?php 

function acakangkahuruf($panjang) {
	$karakter = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ123456789';
	$string = '';

	for ($i=0; $i < $panjang; $i++) { 
		$pos = rand(0, strlen($karakter)-1);
		$string .= $karakter[$pos];
	}
	return $string;
}

?>