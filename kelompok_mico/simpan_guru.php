<?php
$koneksi = new mysqli("localhost", "root", "", "laboran_db");

$kode = $_POST['nip'];
$nama = $_POST['nama_guru'];
$pelajaran = $_POST['pelajaran'];
$kelas = $_POST['kelas_diajar'];
$jam_mulai = $_POST['jam_mulai'];
$jam_selesai = $_POST['jam_selesai'];
$tanggal = date('Y-m-d H:i:s'); // ← TAMBAH INI untuk timestamp

$sql = "INSERT INTO data_guru (nip, nama_guru, pelajaran, kelas_diajar, jam_mulai, jam_selesai, tanggal) 
        VALUES ('$kode', '$nama', '$pelajaran', '$kelas','$jam_mulai','$jam_selesai', '$tanggal')";
        
if($koneksi->query($sql)){
    echo "✅ Data guru berhasil disimpan!<br><a href='index.php'>Kembali</a>";
} else {
    echo "Error: " . $koneksi->error;
}
?>