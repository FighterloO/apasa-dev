<!-- sudah diupdate -->
<?php  
session_start();
require "config.php";

// cek session 

if(isset($_SESSION["loginapasa"])) {
    header("location:index.php?page=dashboard");
    exit;
}

function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[random_int(0, $charactersLength - 1)];
    }
    return $randomString;
}

// Function to get the client IP address
function get_client_ip() {
    $ipaddress = '';
    if (isset($_SERVER['HTTP_CLIENT_IP']))
        $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
    else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
        $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
    else if(isset($_SERVER['HTTP_X_FORWARDED']))
        $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
    else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
        $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
    else if(isset($_SERVER['HTTP_FORWARDED']))
        $ipaddress = $_SERVER['HTTP_FORWARDED'];
    else if(isset($_SERVER['REMOTE_ADDR']))
        $ipaddress = $_SERVER['REMOTE_ADDR'];
    else
        $ipaddress = 'UNKNOWN';
    return $ipaddress;
}

// cek tombol submit sudah ditekan atau belum

if (isset($_POST["submit"])) {

            
  $username = $_POST['username'];
  $password = $_POST['password'];
  $kodecaptcha = $_POST['kodecaptcha'];
    $username = stripslashes($username);
    $password = stripslashes($password);
    $kodecaptcha = stripslashes($kodecaptcha);
    
if ($_SESSION["code"] != $kodecaptcha) {
    ?>
	<script type="text/javascript">     
        alert   ("Kode CAPTCHA Salah");
        window.location.href="login.php";
    </script>
    <?php 
	
}else{


  $result = mysqli_query($conn, "SELECT * FROM datauser WHERE username ='$username'"); 

    if (mysqli_num_rows($result) > 0) {
        $get = mysqli_fetch_assoc($result);
        
        if (password_verify($password, $get['password'])) {
            $level = $get['hakakses'];
            if ($level =="Admin") {
                $randomstringapasav2 = generateRandomString(64);
                $ip = get_client_ip();
                $tglaktiflogin = date("Y/m/d");
                $addloginsession = $conn->query("insert into datalogin (randomstringapasav2, ip, username, tglaktiflogin) values('$randomstringapasav2', '$ip', '$username', '$tglaktiflogin')");
                $addloginsession = true;
                $_SESSION["haudwa7afgur2itgr72rqifagflgfaofoa3filflafnb3libs"] = $randomstringapasav2;
                $_SESSION['noID'] = $get['noID'];
                $_SESSION['nama'] = $get['nama'];
                $_SESSION["hakaksesapasa"] = $get['hakakses'];
                $_SESSION["seksi"] = $get['seksi'];
                $_SESSION["nip"] = $get['nip'];
                header("location: index.php?page=dashboard");
            }elseif ($level =="User") {
                $randomstringapasav2 = generateRandomString(64);
                $ip = get_client_ip();
                $tglaktiflogin = date("Y/m/d");
                $addloginsession = $conn->query("insert into datalogin (randomstringapasav2, ip, username, tglaktiflogin) values('$randomstringapasav2', '$ip', '$username', '$tglaktiflogin')");
                $addloginsession = true;
                $_SESSION["haudwa7afgur2itgr72rqifagflgfaofoa3filflafnb3libs"] = $randomstringapasav2;
                $_SESSION['noID'] = $get['noID'];
                $_SESSION['nama'] = $get['nama'];
                $_SESSION["hakaksesapasa"] =  $get['hakakses'];
                $_SESSION["seksi"] = $get['seksi'];
                $_SESSION["nip"] = $get['nip'];
                header("location: index.php?page=dashboard");
            }elseif ($level =="ADMINPDAD") {
                $randomstringapasav2 = generateRandomString(64);
                $ip = get_client_ip();
                $tglaktiflogin = date("Y/m/d");
                $addloginsession = $conn->query("insert into datalogin (randomstringapasav2, ip, username, tglaktiflogin) values('$randomstringapasav2', '$ip', '$username', '$tglaktiflogin')");
                $addloginsession = true;
                $_SESSION["haudwa7afgur2itgr72rqifagflgfaofoa3filflafnb3libs"] = $randomstringapasav2;
                $_SESSION['noID'] = $get['noID'];
                $_SESSION['nama'] = $get['nama'];
                $_SESSION["hakaksesapasa"] =  $get['hakakses'];
                $_SESSION["seksi"] = $get['seksi'];
                $_SESSION["nip"] = $get['nip'];
                header("location: index.php?page=dashboard");
            }elseif ($level =="KSBU") {
                $randomstringapasav2 = generateRandomString(64);
                $ip = get_client_ip();
                $tglaktiflogin = date("Y/m/d");
                $addloginsession = $conn->query("insert into datalogin (randomstringapasav2, ip, username, tglaktiflogin) values('$randomstringapasav2', '$ip', '$username', '$tglaktiflogin')");
                $addloginsession = true;
                $_SESSION["haudwa7afgur2itgr72rqifagflgfaofoa3filflafnb3libs"] = $randomstringapasav2;
                $_SESSION['noID'] = $get['noID'];
                $_SESSION['nama'] = $get['nama'];
                $_SESSION["hakaksesapasa"] =  $get['hakakses'];
                $_SESSION["seksi"] = $get['seksi'];
                $_SESSION["nip"] = $get['nip'];
                header("location: index.php?page=dashboard");
            }elseif ($level !== "ADMINPDAD" || $level !== "Admin" || $level !== "KSBU" || $level !== "User"){
                ?>
                 <script type="text/javascript">
                    alert   ("Data Tidak Valid");
                    window.location.href="?page=dashboard";
                 </script>
                <?php
            }
        }else{
            ?>
                <script type="text/javascript">
                    alert   ("Maaf Password yang anda masukkan salah!");
                    window.location.href="?page=dashboard";
                </script>
            <?php
        }
    }
    else { echo "<script> alert('Maaf Username yang anda masukkan salah!');
             </script>";
            };
}
}
?>


<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, minimum-scale=1, maximum-scale=1">
    <title>Login - APASA V2</title>
    <link rel="icon" type="image/png" href="assets/images/icon/logobckuning.png">
    <link rel="shortcut icon" type="image/png" href="assets/images/icon/logotitle.png">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/themify-icons.css">
    <link rel="stylesheet" href="assets/css/metisMenu.css">
    <link rel="stylesheet" href="assets/css/owl.carousel.min.css">
    <link rel="stylesheet" href="assets/css/slicknav.min.css">
    <!-- amchart css -->
    <link rel="stylesheet" href="https://www.amcharts.com/lib/3/plugins/export/export.css" type="text/css" media="all" />
    <!-- others css -->
    <link rel="stylesheet" href="assets/css/typography.css">
    <link rel="stylesheet" href="assets/css/default-css.css">
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="stylesheet" href="assets/css/responsive.css">
    <!-- modernizr css -->
    <script src="assets/js/vendor/modernizr-2.8.3.min.js"></script>
</head>

<body>
    <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
    <!-- preloader area start -->
    <div id="preloader">
        <div class="loader"></div>
    </div>
    <!-- preloader area end -->
    <!-- login area start -->
    <div class="login-area">
        <div class="container">
            <div class="login-box ptb--100">
                <form method="post" action="">
                    <div class="login-form-head" style="background-color:#007bff;">
                        <img style="width:90px; height:70px;" src="assets/images/logobckuning.png" alt="logo">
                    </div>
                    <div class="login-form-body">
                        <div class="form-gp">
                            <label for="exampleInputEmail1">Username</label>
                            <input type="text" id="exampleInputEmail1" name="username" required="">
                            <i class="ti-user"></i>
                            <div class="text-danger"></div>
                        </div>
                        <div class="form-gp">
                            <label for="exampleInputPassword1">Password</label>
                            <input type="password" id="exampleInputPassword1" class="form-password" name="password" required="">
                            <i class="ti-lock"></i>
                            <div class="text-danger"></div>
                        </div>
                        <div class="form-gp">
                            <label for="captcha">Captcha</label>
                            <input type="text" id="captcha" name="kodecaptcha" required="">
                            <i class="ti-text"></i>
                            <div class="text-danger"></div>
                        </div>
                        <div>
                             <input type="checkbox" id="checkbox" class="form-checkbox"> <label for="checkbox">Show password</label>
                        </div>
                        <div align="center">
                           <img id="imgcaptcha" src="captcha.php"/>
                           <input class="btn btn-primary btn-sm" type="button" id="reloadcaptcha" value="R">
                        </div>
                        <br>
                        <div class="submit-btn-area">
                            <button id="form_submit" type="submit" name="submit">Submit <i class="ti-arrow-right"></i></button>
                        </div>
                        
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- login area end -->

    <!-- jquery latest version -->
    <script src="assets/js/vendor/jquery-2.2.4.min.js"></script>
    <!-- bootstrap 4 js -->
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/owl.carousel.min.js"></script>
    <script src="assets/js/metisMenu.min.js"></script>
    <script src="assets/js/jquery.slimscroll.min.js"></script>
    <script src="assets/js/jquery.slicknav.min.js"></script>
    
    <!-- others plugins -->
    <script src="assets/js/plugins.js"></script>
    <script src="assets/js/scripts.js"></script>
    <script type="text/javascript">
    $(document).ready(function(){       
        $('.form-checkbox').click(function(){
            if($(this).is(':checked')){
                $('.form-password').attr('type','text');
            }else{
                $('.form-password').attr('type','password');
            }
        });
    });
    </script>
    <script>
    $(document).ready(function() {
        $('#reloadcaptcha').click(function(){
            var d = new Date();
            $('#imgcaptcha').attr('src', 'captcha.php?' + d.getTime());
        });
    });
    </script>
</body>

</html>

