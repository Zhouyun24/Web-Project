<?php 

require_once "../config.php";

//jika tombol simpan ditekan
if(isset($_POST['simpan'])) {
    //ambil value elemn yang diposting
    $username   = trim(htmlspecialchars($_POST['username']));
    $nama       = trim(htmlspecialchars($_POST['nama']));
    $jabatan    = $_POST['jabatan'];
    $alamat     = trim(htmlspecialchars($_POST['alamat']));
    $gambar     = trim(htmlspecialchars($_POST['foto']['name']));
    $password   = 1234;
    $pass       = password_hash($password, PASSWORD_DEFAULT);


    //cek username
    $cekusername = mysqli_query($koneksi, "SELECT * FROM tb_user WHERE username = '$username'");
    if (mysqli_num_rows($cekusername) > 0){
        header("location:add-user.php?msg=cancel");
        return;
    }

    //upload gambar
    if($gambar != null){
        $url = 'add-user.php';
        $gambar = uploadimg($url); 
    }else{
        $gambar = 'default.png'; 
    }

    mysqli_query($koneksi ,"INSERT INTO tb_user VALUE(null,'$username','$pass','$nama','$alamat','$jabatan','$gambar')");

    header("location:add-user.php?msg=added");
    return;
}
?>