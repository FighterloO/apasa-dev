<?php
session_start();
function acakCaptcha() {
    $alphabet = "ABCDEFGHIJKLMNPQRSTUVWXYZ";
   
//untuk menyatakan $pass sebagai array
$pass = array(); 
 
   //masukkan -2 dalam string length
    $panjangAlpha = strlen($alphabet) - 2; 
    for ($i = 0; $i < 6; $i++) {
        $n = rand(0, $panjangAlpha);
        $pass[] = $alphabet[$n];
    }
 
   //ubah array menjadi string
    return implode($pass); 
}
 
 // untuk mengacak captcha
$code = acakCaptcha();
$_SESSION["code"] = $code;
 
$dir = 'assets/fonts/';
 
$image = imagecreatetruecolor(170, 60);
$black = imagecolorallocate($image, 0, 0, 0);
$color = imagecolorallocate($image, 30, 144, 255); // red
$white = imagecolorallocate($image, 255, 255, 255);
 
imagefilledrectangle($image,0,0,399,99,$white);
imagettftext ($image, 30, 0, 20, 40, $color, $dir."BebasNeue-Regular.ttf", $code);
 
header("Content-type: image/png");
imagepng($image); 
 
?>