<!-- sudah diupdate -->

<?php 
if ($akses == "ADMINPDAD") {

 ?>
 <!-- Textual inputs start -->

<div class="col-lg-12 mt-2">
    <div class="card">
        <div class="card-body">
    <p><h1 align="center" class="font-weight-bold text-dark">TAMBAH DATAUSER</h1></p>
        </div>
    </div>
</div>

<form method="post" action="">
    <div class="col-12 mt-5">
        <div class="card">
            <div class="card-body">
                <h4 class="header-title">Input Data</h4>
                                       
                <div class="form-group">
                    <label for="example-text-input" class="col-form-label">Nama Pegawai</label>
                    <input class="form-control" type="text" name="nama" required>
                </div>
                <div class="form-group">
                    <label for="example-text-input" class="col-form-label">NIP</label>
                    <input class="form-control" type="text" name="nip" required>
                </div>
                <div class="form-group">
                    <label for="example-text-input" class="col-form-label">Pangkat</label>
                    <input class="form-control" type="text" name="pangkat" required>
                </div>
                <div class="form-group">
                    <label for="example-text-input" class="col-form-label">Golongan</label>
                    <input class="form-control" type="text" name="gol" required>
                </div>
                <div class="form-group">
                    <label for="example-text-input" class="col-form-label">Username</label>
                    <input class="form-control" type="text" name="username" required>
                </div>
                <div class="form-group">
                    <label for="example-text-input" class="col-form-label">Password</label>
                    <input class="form-control" type="text" name="password" required>
                </div> 
                <div class="form-group">
                    <label for="example-text-input" class="col-form-label">Hak Akses</label>
                    <select class="form-control" name="hakakses" required>
                        <option>--</option>
                        <option value="User">User</option>
                        <option value="Admin">Admin RT</option>
                        <option value="KSBU">Kasubbag Umum</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="example-text-input" class="col-form-label">Seksi</label>
                    <select class="form-control" name="seksi" required>
                        <option selected disabled></option>
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


                            <!-- Textual inputs end -->



<?php 
}else{

?>
     <script type="text/javascript">
        alert   ("Akses dilarang");
        window.location.href="?page=dashboard";
     </script>
    <?php
}

 
include 'acakangka.php';


if (isset($_POST["submit"])) {
    $nama = $_POST['nama'];
    $nip = $_POST['nip'];
    $pangkat = $_POST['pangkat'];
    $gol = $_POST['gol'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $hakakses = $_POST['hakakses'];
    $seksi = $_POST['seksi'];

    $result = mysqli_query($conn, "SELECT * FROM datauser WHERE username ='$username'"); 
    if (mysqli_num_rows($result) > 0) {
        ?>
            <script type="text/javascript">
                alert   ("Data sudah ada");
                window.location.href="?page=tambahuser";
            </script>
        <?php
    }else{

    $passwordhash = password_hash($password, PASSWORD_DEFAULT);

    $sql = $conn->query("insert into datauser (nama, nip, pangkat, username, gol, password, hakakses, seksi) values('$nama', '$nip', '$pangkat', '$username', '$gol', '$passwordhash', '$hakakses', '$seksi')");
    
    if ($sql) {
                ?>
                    <script type="text/javascript">     
                        alert   ("Datauser Berhasil Tersimpan");
                        window.location.href="?page=tambahuser";
                    </script>
                 <?php 
              }

    }        
}


 ?>