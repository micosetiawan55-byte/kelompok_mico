<?php
$koneksi = new mysqli("localhost", "root", "", "laboran_db");

$kode = $_POST['nip'];
$nama = $_POST['nama_guru'];
$pelajaran = $_POST['pelajaran'];


$sql = "INSERT INTO guru (nip, nama_guru, pelajaran,) 
        VALUES ('$kode', '$nama', '$pelajaran')";
        
if($koneksi->query($sql)){
    echo "✅ Data pengunjung berhasil disimpan!<br><a href='index.php'>Kembali</a>";
} else {
    echo "Error: " . $koneksi->error;
}
?>
