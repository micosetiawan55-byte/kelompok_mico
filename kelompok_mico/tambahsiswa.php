<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Form Tambah Siswa</title>

  <!-- Google Font -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
  <!-- External CSS -->
  <link rel="stylesheet" href="tambahsiswa.css">
</head>
<body>
  <div class="container">
    <?php
    include("koneksi.php");

    // Inisialisasi variabel
    $error = '';
    $success = '';

    if (isset($_POST['simpan'])) {
        $nis = mysqli_real_escape_string($koneksi, $_POST['nis']);
        $nama_siswa = mysqli_real_escape_string($koneksi, $_POST['nama_siswa']);
        $kelas = mysqli_real_escape_string($koneksi, $_POST['kelas']);

        // Validasi input
        if (empty($nis) || empty($nama_siswa) || empty($kelas)) {
            $error = "❌ Semua field harus diisi!";
        } else {
            // Cek apakah kelas yang dipilih ada di tabel kelas
            $check_kelas = "SELECT kode_kelas FROM kelas WHERE kode_kelas = '$kelas'";
            $result_check = mysqli_query($koneksi, $check_kelas);
            
            if (mysqli_num_rows($result_check) == 0) {
                $error = "❌ Kelas yang dipilih tidak valid! Silakan pilih kelas yang tersedia.";
            } else {
                // Cek apakah NIS sudah ada
                $check_nis = "SELECT nis FROM siswa WHERE nis = '$nis'";
                $result_nis = mysqli_query($koneksi, $check_nis);
                
                if (mysqli_num_rows($result_nis) > 0) {
                    $error = "❌ NIS sudah terdaftar! Gunakan NIS yang berbeda.";
                } else {
                    // Insert data dengan prepared statement (lebih aman)
                    $sql = "INSERT INTO siswa (nis, nama_siswa, kelas) VALUES (?, ?, ?)";
                    $stmt = mysqli_prepare($koneksi, $sql);
                    
                    if ($stmt) {
                        mysqli_stmt_bind_param($stmt, "sss", $nis, $nama_siswa, $kelas);
                        
                        if (mysqli_stmt_execute($stmt)) {
                            $success = "✅ Data siswa berhasil ditambahkan!";
                            // Reset form
                            echo "<script>
                                    setTimeout(function() {
                                        document.getElementById('studentForm').reset();
                                    }, 1000);
                                  </script>";
                        } else {
                            $error = "❌ Gagal menambahkan data: " . mysqli_error($koneksi);
                        }
                        mysqli_stmt_close($stmt);
                    } else {
                        $error = "❌ Error dalam prepared statement: " . mysqli_error($koneksi);
                    }
                }
            }
        }
    }

    // Ambil data kelas untuk dropdown
    $kelas_query = "SELECT kode_kelas, nama_kelas FROM kelas ORDER BY kode_kelas";
    $kelas_result = mysqli_query($koneksi, $kelas_query);
    $kelas_options = '';
    
    if ($kelas_result && mysqli_num_rows($kelas_result) > 0) {
        while ($row = mysqli_fetch_assoc($kelas_result)) {
            $kelas_options .= "<option value='{$row['kode_kelas']}'>{$row['kode_kelas']} - {$row['nama_kelas']}</option>";
        }
    } else {
        $error = "❌ Tidak ada data kelas yang tersedia. Harap tambahkan kelas terlebih dahulu.";
    }
    ?>
    
    <h2>Tambah Siswa Baru</h2>
    <a class="top-link" href="form_siswa.php">← Kembali ke Form Siswa</a>

    <?php if ($error): ?>
        <div class="error-message"><?php echo $error; ?></div>
    <?php endif; ?>

    <?php if ($success): ?>
        <div class="success-message"><?php echo $success; ?></div>
    <?php endif; ?>

    <form action="" method="post" id="studentForm">
      <div class="form-group">
        <label for="nis">NIS</label>
        <input type="number" name="nis" id="nis" required 
               min="100000" max="999999" 
               placeholder="Masukkan 6 digit NIS">
      </div>

      <div class="form-group">
        <label for="nama_siswa">Nama Siswa</label>
        <input type="text" name="nama_siswa" id="nama_siswa" required 
               placeholder="Masukkan nama lengkap siswa">
      </div>

      <div class="form-group">
        <label for="kelas">Kelas</label>
        <select name="kelas" id="kelas" required>
          <option value="">-- Pilih Kelas --</option>
          <?php echo $kelas_options; ?>
        </select>
        <small class="form-hint">Pastikan kelas yang dipilih sudah terdaftar</small>
      </div>

      <div class="btn-group">
        <button type="submit" name="simpan" class="btn-primary">💾 Simpan</button>
        <button type="reset" class="btn-reset">🔄 Reset</button>
      </div>
    </form>
  </div>

  <script>
    // Validasi client-side
    document.getElementById('studentForm').addEventListener('submit', function(e) {
      const nis = document.getElementById('nis').value;
      const nama = document.getElementById('nama_siswa').value;
      const kelas = document.getElementById('kelas').value;
      
      if (!nis || !nama || !kelas) {
        alert('Harap lengkapi semua field!');
        e.preventDefault();
        return false;
      }
      
      if (nis.length !== 6) {
        alert('NIS harus 6 digit!');
        e.preventDefault();
        return false;
      }
      
      return true;
    });

    // Auto-hide messages setelah 5 detik
    setTimeout(function() {
      const messages = document.querySelectorAll('.error-message, .success-message');
      messages.forEach(function(msg) {
        msg.style.display = 'none';
      });
    }, 5000);
  </script>
</body>
</html>