<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Data Kunjungan Kelas - Admin</title>
  <!-- Google Font & Icons -->
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
  <!-- External CSS -->
  <link rel="stylesheet" href="kelasdiadmin.css">
</head>
<body>
  <div class="container">
    <aside class="sidebar">
      <div class="sidebar-header">
        <h2 class="logo"><i class="fas fa-chalkboard"></i> Dashboard</h2>
      </div>
      <nav class="nav-menu">
        <a href="dashboard.php" class="nav-link">
          <i class="fas fa-tachometer-alt"></i>
          <span>Dashboard</span>
        </a>
        <a href="gurudiadmin.php" class="nav-link">
          <i class="fas fa-user-tie"></i>
          <span>Guru</span>
        </a>
        <a href="siswadiadmin.php" class="nav-link">
          <i class="fas fa-user-graduate"></i>
          <span>Siswa</span>
        </a>
        <a href="kelasdiadmin.php" class="nav-link active">
          <i class="fas fa-door-open"></i>
          <span>Kelas</span>
        </a>
        <a href="peralatandiadmin.php" class="nav-link">
          <i class="fas fa-tools"></i>
          <span>Peralatan</span>
        </a>
        <a href="logout.php" class="nav-link logout">
          <i class="fas fa-sign-out-alt"></i>
          <span>Logout</span>
        </a>
      </nav>
    </aside>

    <div class="main-content">
      <div class="content-header">
        <h1><i class="fas fa-calendar-alt"></i> Data Kunjungan Kelas</h1>
        <div class="header-actions">
          <button class="btn btn-primary" onclick="window.print()">
            <i class="fas fa-print"></i>
            Cetak Laporan
          </button>
          <button class="btn btn-secondary" onclick="exportToExcel()">
            <i class="fas fa-download"></i>
            Export Excel
          </button>
        </div>
      </div>

      <?php
        include("koneksi.php");
        $sql = "SELECT * FROM data_kelas ORDER BY tanggal DESC, jam_mulai DESC";
        $hasil = mysqli_query($koneksi, $sql);

        if (!$hasil) {
          echo "Error Query: " . mysqli_error($koneksi);
        }

        $total_kunjungan = mysqli_num_rows($hasil);
      ?>

      <div class="stats-container">
        <div class="stat-card">
          <div class="stat-icon">
            <i class="fas fa-calendar-check"></i>
          </div>
          <div class="stat-info">
            <h3><?php echo $total_kunjungan; ?></h3>
            <p>Total Kunjungan</p>
          </div>
        </div>
        <div class="stat-card">
          <div class="stat-icon">
            <i class="fas fa-chalkboard-teacher"></i>
          </div>
          <div class="stat-info">
            <h3>
              <?php
              $sql_guru = "SELECT COUNT(DISTINCT nip) as total_guru FROM data_kelas";
              $result_guru = mysqli_query($koneksi, $sql_guru);
              $total_guru = mysqli_fetch_assoc($result_guru)['total_guru'] ?? 0;
              echo $total_guru;
              ?>
            </h3>
            <p>Guru Aktif</p>
          </div>
        </div>
        <div class="stat-card">
          <div class="stat-icon">
            <i class="fas fa-door-open"></i>
          </div>
          <div class="stat-info">
            <h3>
              <?php
              $sql_kelas = "SELECT COUNT(DISTINCT kode_kelas) as total_kelas FROM data_kelas";
              $result_kelas = mysqli_query($koneksi, $sql_kelas);
              $total_kelas = mysqli_fetch_assoc($result_kelas)['total_kelas'] ?? 0;
              echo $total_kelas;
              ?>
            </h3>
            <p>Kelas Terpakai</p>
          </div>
        </div>
      </div>

      <div class="table-container">
        <div class="table-header">
          <div class="search-box">
            <i class="fas fa-search"></i>
            <input type="text" id="searchInput" placeholder="Cari kunjungan...">
          </div>
          <div class="table-info">
            <span class="total-records">
              <i class="fas fa-database"></i>
              Total Data: <?php echo $total_kunjungan; ?>
            </span>
          </div>
        </div>

        <div class="table-wrapper">
          <table id="kunjunganTable">
            <thead>
              <tr>
                <th class="text-center">No</th>
                <th>Kelas</th>
                <th>Guru</th>
                <th>Mata Pelajaran</th>
                <th class="text-center">Jumlah Siswa</th>
                <th class="text-center">Waktu</th>
                <th class="text-center">Tanggal</th>
                <th class="text-center">Durasi</th>
              </tr>
            </thead>
            <tbody>
              <?php 
              $no = 1;
              while ($data = mysqli_fetch_assoc($hasil)) { 
                $jam_mulai = new DateTime($data['jam_mulai']);
                $jam_selesai = new DateTime($data['jam_selesai']);
                $durasi = $jam_mulai->diff($jam_selesai);
              ?>
              <tr>
                <td class="text-center"><?php echo $no++; ?></td>
                <td>
                  <div class="class-info">
                    <div class="class-avatar">
                      <i class="fas fa-door-open"></i>
                    </div>
                    <div class="class-details">
                      <div class="class-name"><?php echo htmlspecialchars($data['nama_kelas']); ?></div>
                      <div class="class-code"><?php echo htmlspecialchars($data['kode_kelas']); ?></div>
                    </div>
                  </div>
                </td>
                <td>
                  <div class="teacher-info">
                    <div class="teacher-avatar">
                      <i class="fas fa-user-tie"></i>
                    </div>
                    <div class="teacher-details">
                      <div class="teacher-name"><?php echo htmlspecialchars($data['nama_guru']); ?></div>
                      <div class="teacher-nip">NIP: <?php echo htmlspecialchars($data['nip']); ?></div>
                    </div>
                  </div>
                </td>
                <td>
                  <span class="subject-badge"><?php echo htmlspecialchars($data['pelajaran']); ?></span>
                </td>
                <td class="text-center">
                  <span class="student-count"><?php echo htmlspecialchars($data['jumlah']); ?></span>
                </td>
                <td class="text-center">
                  <div class="time-info">
                    <div class="time-start"><?php echo date('H:i', strtotime($data['jam_mulai'])); ?></div>
                    <div class="time-separator">-</div>
                    <div class="time-end"><?php echo date('H:i', strtotime($data['jam_selesai'])); ?></div>
                  </div>
                </td>
                <td class="text-center">
                  <span class="date-badge"><?php echo date('d/m/Y', strtotime($data['tanggal'])); ?></span>
                </td>
                <td class="text-center">
                  <span class="duration-badge"><?php echo $durasi->h . 'j ' . $durasi->i . 'm'; ?></span>
                </td>
              </tr>
              <?php } ?>
            </tbody>
          </table>

          <?php if($total_kunjungan == 0): ?>
          <div class="empty-state">
            <i class="fas fa-calendar-times"></i>
            <h3>Belum Ada Data Kunjungan</h3>
            <p>Belum ada riwayat kunjungan kelas yang tercatat dalam sistem.</p>
          </div>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </div>

  <script>
    // Search functionality
    document.getElementById('searchInput').addEventListener('input', function(e) {
      const searchTerm = e.target.value.toLowerCase();
      const rows = document.querySelectorAll('#kunjunganTable tbody tr');
      
      rows.forEach(row => {
        const text = row.textContent.toLowerCase();
        row.style.display = text.includes(searchTerm) ? '' : 'none';
      });
    });

    // Hover effects for table rows
    const tableRows = document.querySelectorAll('#kunjunganTable tbody tr');
    tableRows.forEach(row => {
      row.addEventListener('mouseenter', function() {
        this.style.transform = 'translateY(-2px)';
        this.style.boxShadow = '0 4px 15px rgba(0,0,0,0.1)';
      });
      
      row.addEventListener('mouseleave', function() {
        this.style.transform = 'translateY(0)';
        this.style.boxShadow = 'none';
      });
    });

    // Export to Excel functionality
    function exportToExcel() {
      alert('Fitur export Excel akan mengunduh data kunjungan kelas.');
      // Implement export functionality here
    }

    // Print functionality
    function printReport() {
      window.print();
    }
  </script>
</body>
</html>