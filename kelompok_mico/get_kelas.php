<?php
$koneksi = new mysqli("localhost", "root", "", "laboran_db");

if(isset($_POST['query'])){
    $query = $koneksi->real_escape_string($_POST['query']);
    $result = $koneksi->query("SELECT * FROM kelas WHERE nama_kelas LIKE '%$query%' LIMIT 50");

    while($row = $result->fetch_assoc()){
        echo "<div class='pilihKelas' 
                 data-kode_kelas='".$row['kode_kelas']."' 
                 data-nama_kelas='".$row['nama_kelas']."'>
                 ".$row['nama_kelas']."
              </div>";
    }
}
?>
