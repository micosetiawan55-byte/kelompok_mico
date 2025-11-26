<?php
include("koneksi.php");
if (isset ($_GET['id_peralatan'])){
    $id=$_GET ['id_peralatan'];
$sql = "delete from peralatan where id_peralatan = $id";
$query =mysqli_query ($koneksi, $sql);

if ($query){
    echo"data berhasil dihapus";
    header("location: peralatandiadmin.php");
    exit;
}else{
    echo"gagal menghapus data" . mysqli_error($koneksi);
}
}else{
    echo"id tidk ditemukan";
}
?>

