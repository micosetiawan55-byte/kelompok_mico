<?php
$koneksi = new mysqli("localhost", "root", "", "laboran_db");

if(isset($_POST['query'])){
    $query = $koneksi->real_escape_string($_POST['query']);
    $result = $koneksi->query("SELECT * FROM siswa WHERE nama_siswa LIKE '%$query%' LIMIT 10");

    while($row = $result->fetch_assoc()){
        echo "<div class='pilih' 
                 data-nis='".$row['nis']."' 
                 data-nama_siswa='".$row['nama_siswa']."' 
                 data-kelas='".$row['kelas']."'>
                 ".$row['nama_siswa']."
              </div>";
    }
}
?>
