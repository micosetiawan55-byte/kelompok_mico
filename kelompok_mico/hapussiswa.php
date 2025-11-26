<?php
include("koneksi.php");
if (isset ($_GET['nis'])){
    $id=$_GET ['nis'];
$sql = "delete from siswa where nis = $id";
$query =mysqli_query ($koneksi, $sql);

if ($query){
    echo"data berhasil dihapus";
    header("location: isisiswa.php");
    exit;
}else{
    echo"gagal menghapus data" . mysqli_error($koneksi);
}
}else{
    echo"id tidk ditemukan";
}
?>

