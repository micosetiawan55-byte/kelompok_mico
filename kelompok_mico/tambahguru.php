<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tambah Guru</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="tambahguru.css">
</head>
<body>
  <div class="container">
    <?php
    include("koneksi.php");
    
    // Variabel untuk menyimpan pesan
    $message = '';
    $message_type = '';
    
    if(isset($_POST['simpan'])){
      $nip = $_POST['nip'];
      $namaguru = $_POST['nama_guru'];
      $pelajaran = $_POST['pelajaran'];

      // Validasi input
      if(empty($nip) || empty($namaguru) || empty($pelajaran)) {
        $message = "❌ Semua field harus diisi!";
        $message_type = 'error';
      } else {
        $sql = "INSERT INTO guru (nip, nama_guru, pelajaran) 
                VALUES ('$nip','$namaguru','$pelajaran')";
        $query = mysqli_query($koneksi, $sql);
        
        if ($query){
          $message = "✅ Data guru berhasil ditambahkan!";
          $message_type = 'success';
          // Reset form setelah berhasil
          echo '<script>
                  setTimeout(function() {
                    document.getElementById("guruForm").reset();
                  }, 1000);
                </script>';
        } else {
          $message = "❌ Gagal menambahkan data: " . mysqli_error($koneksi);
          $message_type = 'error';
        }
      }
    }
    ?>

    <div class="form-card">
      <div class="form-header">
        <h2>Tambah Guru Baru</h2>
        <p>Isi form berikut untuk menambahkan data guru baru</p>
      </div>

      <a class="back-link" href="form_guru.php">
        <span class="icon">←</span>
        Kembali ke Data Guru
      </a>

      <?php if(!empty($message)): ?>
        <div class="message <?php echo $message_type; ?>">
          <?php echo $message; ?>
        </div>
      <?php endif; ?>

      <form action="" method="post" id="guruForm">
        <div class="form-group">
          <label for="nip">
            <span class="label-text">NIP</span>
            <span class="required">*</span>
          </label>
          <input type="number" name="nip" id="nip" required 
                 placeholder="Masukkan NIP guru">
          <div class="input-info">Nomor Induk Pegawai (hanya angka)</div>
        </div>

        <div class="form-group">
          <label for="nama_guru">
            <span class="label-text">Nama Guru</span>
            <span class="required">*</span>
          </label>
          <input type="text" name="nama_guru" id="nama_guru" required 
                 placeholder="Masukkan nama lengkap guru">
        </div>

        <div class="form-group">
          <label for="pelajaran">
            <span class="label-text">Mata Pelajaran</span>
            <span class="required">*</span>
          </label>
          <input type="text" name="pelajaran" id="pelajaran" required 
                 placeholder="Masukkan mata pelajaran">
        </div>

        <div class="form-actions">
          <button type="submit" name="simpan" class="btn btn-primary">
            <span class="btn-icon">💾</span>
            Simpan Data
          </button>
          <button type="reset" class="btn btn-secondary">
            <span class="btn-icon">🔄</span>
            Reset Form
          </button>
        </div>
      </form>
    </div>
  </div>

  <script>
    // Animasi untuk tombol
    document.addEventListener('DOMContentLoaded', function() {
      const buttons = document.querySelectorAll('.btn');
      buttons.forEach(button => {
        button.addEventListener('mouseenter', function() {
          this.style.transform = 'translateY(-2px)';
        });
        button.addEventListener('mouseleave', function() {
          this.style.transform = 'translateY(0)';
        });
      });

      // Auto-hide message setelah 5 detik
      const message = document.querySelector('.message');
      if (message) {
        setTimeout(() => {
          message.style.opacity = '0';
          message.style.transform = 'translateY(-10px)';
          setTimeout(() => {
            message.remove();
          }, 300);
        }, 5000);
      }
    });
  </script>
</body>
</html>