<?php
include("koneksi.php");

// Saat user klik tombol simpan perubahan
if (isset($_POST['update'])) {
    $id_peralatan = $_POST['id_peralatan'];
    $namaperalatan = $_POST['nama_peralatan']; 
    $jumlah = $_POST['jumlah'];
    $baik = $_POST['baik'];

    $sql = "UPDATE peralatan
            SET nama_peralatan='$namaperalatan',
                jumlah='$jumlah',
                baik='$baik'
            WHERE id_peralatan='$id_peralatan'";

    $hasil = mysqli_query($koneksi, $sql);

    if ($hasil) {
        header("Location: peralatandiadmin.php");
        exit;
    } else {
        echo "<p style='color:red; text-align:center;'>❌ Gagal mengupdate data: " . mysqli_error($koneksi) . "</p>";
    }
}

// Ambil data peralatan dari ID
$id = $_GET['id_peralatan'];
$sql = "SELECT * FROM peralatan WHERE id_peralatan='$id'";
$hasil = mysqli_query($koneksi, $sql);
$data = mysqli_fetch_assoc($hasil);
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Edit Peralatan</title>
  <!-- Google Font & Icons -->
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
  <!-- External CSS -->
  <link rel="stylesheet" href="editperalatan.css">
</head>
<body>
  <!-- Floating Background Elements -->
  <div class="floating-elements">
    <div class="floating-element"></div>
    <div class="floating-element"></div>
    <div class="floating-element"></div>
  </div>

  <div class="container">
    <div class="header">
      <h2><i class="fas fa-tools"></i> Edit Data Peralatan</h2>
      <a class="top-link" href="peralatandiadmin.php">
        <i class="fas fa-arrow-left"></i>
        Kembali ke Data Peralatan
      </a>
    </div>

    <form action="" method="post" class="form-container">
      <input type="hidden" name="id_peralatan" value="<?php echo $data['id_peralatan']; ?>">

      <div class="form-group">
        <label for="nama_peralatan">
          <i class="fas fa-toolbox"></i>
          Nama Peralatan
        </label>
        <input type="text" name="nama_peralatan" id="nama_peralatan" class="input-field"
               value="<?php echo $data['nama_peralatan']; ?>" required
               placeholder="Masukkan nama peralatan">
      </div>

      <div class="form-group">
        <label for="jumlah">
          <i class="fas fa-cubes"></i>
          Jumlah Total
        </label>
        <input type="number" name="jumlah" id="jumlah" class="input-field"
               value="<?php echo $data['jumlah']; ?>" required min="0" max="1000"
               placeholder="Masukkan jumlah total">
        <small class="form-hint">Jumlah keseluruhan peralatan yang tersedia</small>
      </div>

      <div class="form-group">
        <label for="baik">
          <i class="fas fa-check-circle"></i>
          Kondisi Baik
        </label>
        <input type="number" name="baik" id="baik" class="input-field"
               value="<?php echo $data['baik']; ?>" required min="0" 
               placeholder="Masukkan jumlah kondisi baik">
        <small class="form-hint">Jumlah peralatan dalam kondisi baik (tidak boleh melebihi jumlah total)</small>
      </div>

      <div class="button-group">
        <button type="submit" name="update" class="btn btn-primary">
          <i class="fas fa-save"></i>
          Simpan Perubahan
        </button>
        <button type="reset" class="btn btn-reset">
          <i class="fas fa-undo"></i>
          Reset Form
        </button>
      </div>
    </form>
  </div>

  <script>
    // Validasi client-side
    document.querySelector('form').addEventListener('submit', function(e) {
      const jumlah = parseInt(document.getElementById('jumlah').value);
      const baik = parseInt(document.getElementById('baik').value);
      
      if (baik > jumlah) {
        alert('❌ Jumlah kondisi baik tidak boleh melebihi jumlah total!');
        e.preventDefault();
        return false;
      }
      
      if (jumlah < 0 || baik < 0) {
        alert('❌ Nilai tidak boleh negatif!');
        e.preventDefault();
        return false;
      }
      
      return true;
    });

    // Auto-calculate rusak
    document.getElementById('jumlah').addEventListener('input', updateRusak);
    document.getElementById('baik').addEventListener('input', updateRusak);
    
    function updateRusak() {
      const jumlah = parseInt(document.getElementById('jumlah').value) || 0;
      const baik = parseInt(document.getElementById('baik').value) || 0;
      const rusak = jumlah - baik;
      
      if (rusak >= 0) {
        document.getElementById('rusak-display').textContent = rusak;
      }
    }

    // Initialize on load
    updateRusak();
  </script>
</body>
</html>