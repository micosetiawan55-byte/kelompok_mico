<?php
include("koneksi.php");

// Saat user klik tombol simpan perubahan
if (isset($_POST['update'])) {
    $kodekelas = $_POST['kodekelas_lama']; 
    $kode_kelas= $_POST['kode_kelas']; 
    $namakelas  = $_POST['nama_kelas'];
    $jumlahsiswa = $_POST['jumlah_siswa'];

    $sql = "UPDATE kelas
            SET kode_kelas='$kode_kelas',
                nama_kelas='$namakelas',
                jumlah_siswa='$jumlahsiswa'
            WHERE kode_kelas='$kodekelas'";

    $hasil = mysqli_query($koneksi, $sql);

    if ($hasil) {
        header("Location: isikelas.php");
        exit;
    } else {
        echo "<p style='color:red; text-align:center;'>❌ Gagal mengupdate data: " . mysqli_error($koneksi) . "</p>";
    }
}

// Ambil data kelas dari kode_kelas (GET)
$kodekelas = $_GET['kode_kelas'];
$sql = "SELECT * FROM kelas WHERE kode_kelas='$kodekelas'";
$hasil = mysqli_query($koneksi, $sql);
$data = mysqli_fetch_assoc($hasil);
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Edit Data Kelas</title>
  <!-- Google Font -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
  <!-- External CSS -->
  <link rel="stylesheet" href="editkelas.css">
</head>
<body>
  <div class="container">
    <h2>Edit Data Kelas</h2>
    <a class="top-link" href="isikelas.php">← Kembali ke Data Kelas</a>

    <form action="" method="post">
      <div class="form-group">
        <label for="kode_kelas">Kode Kelas</label>
        <input type="text" name="kode_kelas" id="kode_kelas" value="<?php echo $data['kode_kelas']; ?>" required>
        <input type="hidden" name="kodekelas_lama" value="<?php echo $data['kode_kelas']; ?>">
      </div>

      <div class="form-group">
        <label for="nama_kelas">Nama Kelas</label>
        <input type="text" name="nama_kelas" id="nama_kelas" value="<?php echo $data['nama_kelas']; ?>" required>
      </div>

      <div class="form-group">
        <label for="jumlah_siswa">Jumlah Siswa</label>
        <input type="number" name="jumlah_siswa" id="jumlah_siswa" value="<?php echo $data['jumlah_siswa']; ?>" required min="0" max="50">
      </div>

      <div class="btn-group">
        <input type="submit" name="update" value="💾 Simpan Perubahan" class="btn-primary">
        <button type="reset" class="btn-reset">🔄 Reset</button>
      </div>
    </form>
  </div>
</body>
</html>