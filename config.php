<?php 

//Membuat Koneksi
$koneksi = mysqli_connect("localhost","root","","db_sekolah");

//Cek Kondisi
// if(mysqli_connect_errno()){
//     echo "Koneksi gagal";
// }else{
//     echo "Berhasil";
// }

$main_url = "http://localhost/sekolah/";

function uploadimg($url){
    $namafile = $_FILES['foto']['name'];
    $ukuran = $_FILES['foto']['size'];
    $error = $_FILES['foto']['error'];
    $tmp = $_FILES['foto']['tmp_name'];


    //cek file yg diupload
    $validExtention = ['jpg','jpeg','png'];
    $fileExtention = explode('.', $namafile);
    $fileExtention = strtolower(end($fileExtention));
    if(!in_array($fileExtention, $validExtention)){
        header("location:" . $url . '?msg=notimage');
        die;
    }

    //Cek ukuran gambar
    if ($ukuran > 1000000) {
        header("location:" . $url . '?msg=oversize');
        die;
    }

    //generate nama file gambar
    $namafilebaru = rand(10, 1000). '-' . $namafile;

    //upload gambar
    move_uploaded_file($tmp, "../asset/image/" . $namafilebaru);
    return $namafilebaru;
}
?>