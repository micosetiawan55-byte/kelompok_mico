<?php
$koneksi = new mysqli("localhost", "root", "", "laboran_db");

if(isset($_POST['query'])){
    $query = $koneksi->real_escape_string($_POST['query']);
    $result = $koneksi->query("SELECT * FROM guru WHERE nama_guru LIKE '%$query%' LIMIT 50");

    while($row = $result->fetch_assoc()){
        echo "<div class='pilih' 
                 data-nip='".$row['nip']."' 
                 data-nama_guru='".$row['nama_guru']."' 
                 data-pelajaran='".$row['pelajaran']."'>
                 ".$row['nama_guru']."
              </div>";
    }
}
?>
