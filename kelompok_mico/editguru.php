<?php
include("koneksi.php");

// Saat user klik tombol simpan perubahan
if (isset($_POST['update'])) {
    $nip_lama = $_POST['nip_lama']; 
    $nip_baru = $_POST['nip']; 
    $namaguru = $_POST['nama_guru'];
    $pelajaran = $_POST['pelajaran'];

    $sql = "UPDATE guru
            SET nip='$nip_baru',
                nama_guru='$namaguru',
                pelajaran='$pelajaran'
            WHERE nip='$nip_lama'";

    $hasil = mysqli_query($koneksi, $sql);

    if ($hasil) {
        header("Location: isiguru.php");
        exit;
    } else {
        echo "<p style='color:red; text-align:center;'>❌ Gagal mengupdate data: " . mysqli_error($koneksi) . "</p>";
    }
}

// Ambil data guru dari NIP (GET)
$nip = $_GET['nip'];
$sql = "SELECT * FROM guru WHERE nip='$nip'";
$hasil = mysqli_query($koneksi, $sql);
$data = mysqli_fetch_assoc($hasil);
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Edit Data Guru</title>
  <!-- Google Font -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
  <!-- CSS External -->
  <link rel="stylesheet" href="editguru.css">
</head>
<body>
  <div class="container">
    <h2>Edit Data Guru</h2>
    <a class="top-link" href="isiguru.php">← Kembali ke Data Guru</a>

    <form action="" method="post">
      <div class="form-group">
        <label for="nip">NIP</label>
        <input type="text" name="nip" id="nip" value="<?php echo $data['nip']; ?>" required>
        <input type="hidden" name="nip_lama" value="<?php echo $data['nip']; ?>">
      </div>

      <div class="form-group">
        <label for="nama_guru">Nama Guru</label>
        <input type="text" name="nama_guru" id="nama_guru" value="<?php echo $data['nama_guru']; ?>" required>
      </div>

      <div class="form-group">
        <label for="pelajaran">Pelajaran</label>
        <input type="text" name="pelajaran" id="pelajaran" value="<?php echo $data['pelajaran']; ?>" required>
      </div>

      <div class="btn-group">
        <input type="submit" name="update" value="💾 Simpan Perubahan" class="btn-primary">
        <button type="reset" class="btn-reset">🔄 Reset</button>
      </div>
    </form>
  </div>
</body>
</html>