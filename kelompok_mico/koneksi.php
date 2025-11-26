<?php
$koneksi = mysqli_connect("localhost","root","","laboran_db");

// cek koneksi
if(!$koneksi){
    die("Gagal terhubung" . mysqli_connect_error());
}else{
    echo"";
}
?>