<?php
include("koneksi.php");
if (isset ($_GET['nip'])){
    $id=$_GET ['nip'];
$sql = "delete from guru where nip = $id";
$query =mysqli_query ($koneksi, $sql);

if ($query){
    echo"data berhasil dihapus";
    header("location: isiguru.php");
    exit;
}else{
    echo"gagal menghapus data" . mysqli_error($koneksi);
}
}else{
    echo"id tidk ditemukan";
}
?>

