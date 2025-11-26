<?php
$koneksi = new mysqli("localhost", "root", "", "laboran_db");

$nis = $_POST['nis'];
$nama_siswa = $_POST['nama_siswa'];
$kelas = $_POST['kelas'];
$keperluan = $_POST['keperluan'];
$jam_mulai = $_POST['jam_mulai'];
$jam_selesai = $_POST['jam_selesai'];
$tanggal = date('Y-m-d H:i:s'); // ← TAMBAH INI

$sql = "INSERT INTO data_siswa (nis, nama_siswa, kelas, keperluan, jam_mulai, jam_selesai, tanggal) 
        VALUES ('$nis', '$nama_siswa', '$kelas', '$keperluan','$jam_mulai','$jam_selesai', '$tanggal')";
        
if($koneksi->query($sql)){
    echo "✅ Data siswa berhasil disimpan!<br><a href='index.php'>Kembali</a>";
} else {
    echo "Error: " . $koneksi->error;
}
?>