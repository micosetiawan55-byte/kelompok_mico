<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Data Siswa</title>
  <link rel="stylesheet" href="siswadiadmin.css">
</head>
<body>
  <div class="container">
    <aside class="sidebar">
      <h2 class="logo">Dashboard</h2>
      <nav class="nav-menu">
        <a href="dashboard.php">
          <span class="icon">📋</span>
          <span class="text">Dashboard</span>
        </a>
        <a href="gurudiadmin.php">
          <span class="icon">👩‍🏫</span>
          <span class="text">Guru</span>
        </a>
        <a href="siswadiadmin.php" class="active">
          <span class="icon">👨‍🎓</span>
          <span class="text">Siswa</span>
        </a>
        <a href="kelasdiadmin.php">
          <span class="icon">🏫</span>
          <span class="text">Kelas</span>
        </a>
        <a href="peralatandiadmin.php">
          <span class="icon">🛠</span>
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
        <h1>Data Siswa</h1>
        <div class="header-actions">
          <button class="btn btn-primary" id="refreshBtn">Refresh Data</button>
        </div>
      </header>

      <div class="content-wrapper">
        <?php
          include("koneksi.php");
          $sql = "SELECT * FROM data_siswa";
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
                <th>Nama Siswa</th>
                <th>NIS</th>
                <th>Kelas</th>
                <th>Keperluan</th>
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
                <td><?= htmlspecialchars($data['nama_siswa']); ?></td>
                <td><?= htmlspecialchars($data['nis']); ?></td>
                <td><?= htmlspecialchars($data['kelas']); ?></td>
                <td><?= htmlspecialchars($data['keperluan']); ?></td>
                <td><?= htmlspecialchars($data['jam_mulai']); ?></td>
                <td><?= htmlspecialchars($data['jam_selesai']); ?></td>
                <td><?= htmlspecialchars($data['tanggal']); ?></td>
              </tr>
              <?php 
                  }
                } else {
                  echo "<tr><td colspan='8' class='no-data'>Tidak ada data siswa</td></tr>";
                }
              ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

  <script>
    // Refresh button functionality
    document.getElementById('refreshBtn').addEventListener('click', function() {
      location.reload();
    });
  </script>
</body>
</html>