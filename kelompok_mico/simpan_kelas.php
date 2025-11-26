<?php
$koneksi = new mysqli("localhost", "root", "", "laboran_db");

$nama_kelas = $_POST['nama_kelas'];
$kode_kelas = $_POST['kode_kelas'];
$nama_guru = $_POST['nama_guru'];
$kode_guru = $_POST['nip'];
$pelajaran = $_POST['pelajaran'];
$jumlah = $_POST['jumlah'];
$jam_mulai = $_POST['jam_mulai'];
$jam_selesai = $_POST['jam_selesai'];
$tanggal = date('Y-m-d H:i:s'); // ← TAMBAH INI

$sql = "INSERT INTO data_kelas (nama_kelas, kode_kelas, nama_guru, nip, pelajaran, jumlah, jam_mulai, jam_selesai, tanggal) 
        VALUES ('$nama_kelas', '$kode_kelas', '$nama_guru', '$kode_guru', '$pelajaran', '$jumlah','$jam_mulai','$jam_selesai', '$tanggal')";

if($koneksi->query($sql)){
    echo "✅ Data kelas berhasil disimpan!<br><a href='index.php'>Kembali</a>";
} else {
    echo "❌ Error: " . $koneksi->error;
}
?>