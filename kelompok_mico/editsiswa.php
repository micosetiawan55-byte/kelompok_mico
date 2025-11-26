<?php
include("koneksi.php");

// Saat user klik tombol simpan perubahan
if (isset($_POST['update'])) {
    $nis_lama = $_POST['nis_lama']; 
    $nis_baru = $_POST['nis']; 
    $namasiswa = $_POST['nama_siswa'];
    $kelas = $_POST['kelas'];

    $sql = "UPDATE siswa
            SET nis='$nis_baru',
                nama_siswa='$namasiswa',
                kelas='$kelas'
            WHERE nis='$nis_lama'";

    $hasil = mysqli_query($koneksi, $sql);

    if ($hasil) {
        header("Location: isisiswa.php");
        exit;
    } else {
        echo "<p style='color:red; text-align:center;'>❌ Gagal mengupdate data: " . mysqli_error($koneksi) . "</p>";
    }
}

// Ambil data siswa dari NIS (GET)
$nis = $_GET['nis'];
$sql = "SELECT * FROM siswa WHERE nis='$nis'";
$hasil = mysqli_query($koneksi, $sql);
$data = mysqli_fetch_assoc($hasil);

// Ambil data kelas untuk dropdown
$kelas_query = "SELECT kode_kelas, nama_kelas FROM kelas ORDER BY kode_kelas";
$kelas_result = mysqli_query($koneksi, $kelas_query);
$kelas_options = '';
if ($kelas_result && mysqli_num_rows($kelas_result) > 0) {
    while ($row = mysqli_fetch_assoc($kelas_result)) {
        $selected = ($row['kode_kelas'] == $data['kelas']) ? 'selected' : '';
        $kelas_options .= "<option value='{$row['kode_kelas']}' $selected>{$row['kode_kelas']} - {$row['nama_kelas']}</option>";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Edit Data Siswa</title>
  <!-- Google Font & Icons -->
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
  <!-- External CSS -->
  <link rel="stylesheet" href="editsiswa.css">
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
      <h2><i class="fas fa-user-edit"></i> Edit Data Siswa</h2>
      <a class="top-link" href="isisiswa.php">
        <i class="fas fa-arrow-left"></i>
        Kembali ke Data Siswa
      </a>
    </div>

    <form action="" method="post" class="form-container" id="studentForm">
      <div class="form-group">
        <label for="nis">
          <i class="fas fa-id-card"></i>
          NIS
        </label>
        <input type="text" name="nis" id="nis" class="input-field"
               value="<?php echo $data['nis']; ?>" required
               pattern="[0-9]{10,18}" title="NIS harus 10-18 digit angka"
               placeholder="Masukkan NIS siswa">
        <input type="hidden" name="nis_lama" value="<?php echo $data['nis']; ?>">
        <small class="form-hint">Format: 10-18 digit angka</small>
      </div>

      <div class="form-group">
        <label for="nama_siswa">
          <i class="fas fa-user-graduate"></i>
          Nama Siswa
        </label>
        <input type="text" name="nama_siswa" id="nama_siswa" class="input-field"
               value="<?php echo $data['nama_siswa']; ?>" required
               pattern="[a-zA-Z\s\.]{3,100}" title="Nama hanya boleh mengandung huruf, spasi, dan titik"
               placeholder="Masukkan nama lengkap siswa">
        <small class="form-hint">Minimal 3 karakter, hanya huruf, spasi, dan titik</small>
      </div>

      <div class="form-group">
        <label for="kelas">
          <i class="fas fa-chalkboard"></i>
          Kelas
        </label>
        <select name="kelas" id="kelas" class="input-field" required>
          <option value="">-- Pilih Kelas --</option>
          <?php echo $kelas_options; ?>
        </select>
        <small class="form-hint">Pilih kelas yang sesuai dari daftar yang tersedia</small>
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
    document.getElementById('studentForm').addEventListener('submit', function(e) {
      const nis = document.getElementById('nis').value;
      const nama = document.getElementById('nama_siswa').value;
      const kelas = document.getElementById('kelas').value;
      
      // Validasi NIS
      const nisRegex = /^[0-9]{10,18}$/;
      if (!nisRegex.test(nis)) {
        alert('❌ NIS harus terdiri dari 10-18 digit angka!');
        e.preventDefault();
        return false;
      }
      
      // Validasi Nama
      const namaRegex = /^[a-zA-Z\s\.]{3,100}$/;
      if (!namaRegex.test(nama)) {
        alert('❌ Nama hanya boleh mengandung huruf, spasi, dan titik (3-100 karakter)!');
        e.preventDefault();
        return false;
      }
      
      // Validasi Kelas
      if (!kelas) {
        alert('❌ Harap pilih kelas!');
        e.preventDefault();
        return false;
      }
      
      return true;
    });

    // Real-time validation untuk NIS
    document.getElementById('nis').addEventListener('input', function(e) {
      const value = e.target.value;
      if (!/^\d*$/.test(value)) {
        e.target.value = value.replace(/[^\d]/g, '');
      }
    });

    // Real-time validation untuk Nama
    document.getElementById('nama_siswa').addEventListener('input', function(e) {
      const value = e.target.value;
      if (!/^[a-zA-Z\s\.]*$/.test(value)) {
        e.target.value = value.replace(/[^a-zA-Z\s\.]/g, '');
      }
    });
  </script>
</body>
</html>