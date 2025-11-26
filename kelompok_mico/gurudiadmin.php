<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Data Guru</title>
  <style>
    /* CSS Styles */
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    body {
      display: flex;
      background-color: #f5f7fa;
      color: #333;
      min-height: 100vh;
    }

    .sidebar {
      width: 250px;
      background: linear-gradient(180deg, #2c3e50, #1a2530);
      color: white;
      height: 100vh;
      position: fixed;
      padding: 20px 0;
      box-shadow: 3px 0 10px rgba(0, 0, 0, 0.1);
    }

    .logo {
      text-align: center;
      padding: 20px 0;
      font-size: 1.5rem;
      font-weight: 600;
      border-bottom: 1px solid rgba(255, 255, 255, 0.1);
      margin-bottom: 20px;
    }

    .nav-menu {
      display: flex;
      flex-direction: column;
      padding: 0 15px;
    }

    .nav-menu a {
      display: flex;
      align-items: center;
      padding: 12px 15px;
      color: #b0b7c3;
      text-decoration: none;
      border-radius: 8px;
      margin-bottom: 5px;
      transition: all 0.3s ease;
    }

    .nav-menu a:hover {
      background-color: rgba(255, 255, 255, 0.1);
      color: white;
    }

    .nav-menu a.active {
      background-color: #3498db;
      color: white;
    }

    .nav-menu .icon {
      margin-right: 10px;
      font-size: 1.2rem;
    }

    .nav-menu .logout {
      margin-top: auto;
      color: #e74c3c;
    }

    .main-content {
      flex: 1;
      margin-left: 250px;
      padding: 20px;
    }

    .page-header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 30px;
      padding-bottom: 15px;
      border-bottom: 1px solid #e1e5eb;
    }

    .page-header h1 {
      color: #2c3e50;
      font-size: 1.8rem;
    }

    .header-actions {
      display: flex;
      gap: 10px;
    }

    .btn {
      display: flex;
      align-items: center;
      padding: 10px 15px;
      border: none;
      border-radius: 6px;
      cursor: pointer;
      font-weight: 500;
      transition: all 0.3s ease;
      text-decoration: none;
    }

    .btn-secondary {
      background-color: #95a5a6;
      color: white;
    }

    .btn:hover {
      transform: translateY(-2px);
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .btn-secondary:hover {
      background-color: #7f8c8d;
    }

    .btn-icon {
      margin-right: 5px;
    }

    .content-wrapper {
      background-color: white;
      border-radius: 10px;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
      overflow: hidden;
    }

    .table-container {
      overflow-x: auto;
    }

    table {
      width: 100%;
      border-collapse: collapse;
    }

    thead {
      background-color: #f8f9fa;
    }

    th {
      padding: 15px 12px;
      text-align: left;
      font-weight: 600;
      color: #2c3e50;
      border-bottom: 2px solid #e1e5eb;
    }

    td {
      padding: 12px;
      border-bottom: 1px solid #e1e5eb;
    }

    tbody tr {
      transition: all 0.3s ease;
    }

    tbody tr:hover {
      background-color: #f8f9fa;
    }

    .teacher-info {
      display: flex;
      align-items: center;
    }

    .teacher-name {
      font-weight: 500;
    }

    .subject-badge {
      background-color: #e1f5fe;
      color: #0288d1;
      padding: 5px 10px;
      border-radius: 20px;
      font-size: 0.85rem;
      font-weight: 500;
    }

    .time-slot {
      font-family: 'Courier New', monospace;
      background-color: #f5f5f5;
      padding: 4px 8px;
      border-radius: 4px;
      font-size: 0.9rem;
    }

    .date {
      color: #7f8c8d;
      font-size: 0.9rem;
    }

    .action-buttons {
      display: flex;
      gap: 8px;
    }

    .btn-action {
      background: none;
      border: none;
      cursor: pointer;
      padding: 6px;
      border-radius: 4px;
      transition: all 0.2s ease;
    }

    .btn-edit:hover {
      background-color: #e3f2fd;
    }

    .btn-delete:hover {
      background-color: #ffebee;
    }

    .table-footer {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 15px 20px;
      background-color: #f8f9fa;
      border-top: 1px solid #e1e5eb;
    }

    .table-info {
      color: #7f8c8d;
      font-size: 0.9rem;
    }

    .no-data {
      text-align: center;
      padding: 30px;
      color: #7f8c8d;
      font-style: italic;
    }

    .error-message {
      background-color: #ffebee;
      color: #c62828;
      padding: 15px;
      border-radius: 6px;
      margin-bottom: 20px;
      border-left: 4px solid #f44336;
    }

    @media (max-width: 768px) {
      .sidebar {
        width: 70px;
      }
      
      .sidebar .text {
        display: none;
      }
      
      .main-content {
        margin-left: 70px;
      }
      
      .page-header {
        flex-direction: column;
        align-items: flex-start;
        gap: 15px;
      }
      
      .table-footer {
        flex-direction: column;
        gap: 15px;
        align-items: flex-start;
      }
    }
  </style>
</head>
<body>
  <aside class="sidebar">
    <h2 class="logo">Dashboard</h2>
    <nav class="nav-menu">
      <a href="dashboard.php">
        <span class="icon">📋</span>
        <span class="text">Dashboard</span>
      </a>
      <a href="gurudiadmin.php" class="active">
        <span class="icon">👩‍🏫</span>
        <span class="text">Guru</span>
      </a>
      <a href="siswadiadmin.php">
        <span class="icon">👨‍🎓</span>
        <span class="text">Siswa</span>
      </a>
      <a href="kelasdiadmin.php">
        <span class="icon">🏫</span>
        <span class="text">Kelas</span>
      </a>
      <a href="peralatandiadmin.php">
        <span class="icon">🛠️</span>
        <span class="text">Peralatan</span>
      </a>
      <a href="logout.php" class="logout">
        <span class="icon">🚪</span>
        <span class="text">Logout</span>
      </a>
    </nav>
  </aside>

  <div class="main-content">
    <header class="page-header">
      <h1>Data Guru</h1>
      <div class="header-actions">
        <!-- Tombol Tambah Guru telah dihapus -->
        <button class="btn btn-secondary" id="refreshBtn">
          <span class="btn-icon">🔄</span>
          Refresh
        </button>
      </div>
    </header>

    <div class="content-wrapper">
      <?php
      include("koneksi.php");
      $sql = "SELECT * FROM data_guru";
      $hasil = mysqli_query($koneksi, $sql);
      
      if (!$hasil) {
          echo "<div class='error-message'>Error Query: " . mysqli_error($koneksi) . "</div>";
      }
      ?>

      <div class="table-container">
        <table>
          <thead>
            <tr>
              <th>ID Kunjungan</th>
              <th>Nama Guru</th>
              <th>NIP</th>
              <th>Pelajaran</th>
              <th>Kelas Diajar</th>
              <th>Jam Mulai</th>
              <th>Jam Selesai</th>
              <th>Tanggal</th>
            </tr>
          </thead>
          <tbody>
            <?php 
            if (mysqli_num_rows($hasil) > 0) {
              while ($data = mysqli_fetch_assoc($hasil)) { 
            ?>
            <tr>
              <td><?= htmlspecialchars($data['id_kunjungan']); ?></td>
              <td>
                <div class="teacher-info">
                  <span class="teacher-name"><?= htmlspecialchars($data['nama_guru']); ?></span>
                </div>
              </td>
              <td><?= htmlspecialchars($data['nip']); ?></td>
              <td>
                <span class="subject-badge"><?= htmlspecialchars($data['pelajaran']); ?></span>
              </td>
              <td><?= htmlspecialchars($data['kelas_diajar']); ?></td>
              <td>
                <span class="time-slot"><?= htmlspecialchars($data['jam_mulai']); ?></span>
              </td>
              <td>
                <span class="time-slot"><?= htmlspecialchars($data['jam_selesai']); ?></span>
              </td>
              <td>
                <span class="date"><?= htmlspecialchars($data['tanggal']); ?></span>
              </td>
            </tr>
            <?php 
              }
            } else {
              echo "<tr><td colspan='10' class='no-data'>Tidak ada data guru</td></tr>";
            }
            ?>
          </tbody>
        </table>
      </div>

      <div class="table-footer">
        <div class="table-info">
          Menampilkan <strong><?= mysqli_num_rows($hasil); ?></strong> data guru
        </div>
        <div class="table-actions">
          <!-- Tombol Export Data telah dihapus -->
        </div>
      </div>
    </div>
  </div>

  <script>
    // Refresh button functionality
    document.getElementById('refreshBtn').addEventListener('click', function() {
      location.reload();
    });

    // Action buttons functionality
    document.querySelectorAll('.btn-edit').forEach(btn => {
      btn.addEventListener('click', function() {
        const row = this.closest('tr');
        const teacherName = row.querySelector('.teacher-name').textContent;
        alert(`Edit data guru: ${teacherName}`);
      });
    });

    document.querySelectorAll('.btn-delete').forEach(btn => {
      btn.addEventListener('click', function() {
        const row = this.closest('tr');
        const teacherName = row.querySelector('.teacher-name').textContent;
        if (confirm(`Apakah Anda yakin ingin menghapus data guru: ${teacherName}?`)) {
          alert(`Data guru ${teacherName} berhasil dihapus!`);
        }
      });
    });

    // Add hover effects to table rows
    document.querySelectorAll('tbody tr').forEach(row => {
      row.addEventListener('mouseenter', function() {
        this.style.transform = 'translateY(-2px)';
      });
      row.addEventListener('mouseleave', function() {
        this.style.transform = 'translateY(0)';
      });
    });
  </script>
</body>
</html>