<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Data Peralatan</title>
  <link rel="stylesheet" href="peralatandiadmin.css">
</head>
<body>
  <div class="container">
    <aside class="sidebar">
      <h2 class="logo">Dashboard</h2>
      <nav class="nav-menu">
        <a href="dashboard.php">📋 Dashboard</a>
        <a href="gurudiadmin.php">👩‍🏫 Guru</a>
        <a href="siswadiadmin.php">👨‍🎓 Siswa</a>
        <a href="kelasdiadmin.php">🏫 Kelas</a>
        <a href="peralatandiadmin.php" class="active">🛠 Peralatan</a>
        <a href="logout.php">🚪 Logout</a>
      </nav>
    </aside>

    <div class="main-content">
      <header class="content-header">
        <h1>Data Peralatan</h1>
        <div class="header-actions">
          <a href="tambahperalatan.php" class="btn-tambah">+ Tambah Peralatan</a>
        </div>
      </header>

      <div class="content-body">
        <?php
        include("koneksi.php");
        $sql = "SELECT * FROM peralatan";
        $hasil = mysqli_query($koneksi, $sql);

        if (!$hasil) {
          echo "<div class='error-message'>Error Query: " . mysqli_error($koneksi) . "</div>";
        } else if (mysqli_num_rows($hasil) == 0) {
          echo "<div class='empty-state'>Tidak ada data peralatan.</div>";
        } else {
        ?>

        <div class="table-container">
          <table>
            <thead>
              <tr>
                <th>ID Peralatan</th>
                <th>Nama Peralatan</th>
                <th>Jumlah</th>
                <th>Kondisi Baik</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php while ($data = mysqli_fetch_assoc($hasil)) { ?>
              <tr>
                <td><?= htmlspecialchars($data['id_peralatan']); ?></td>
                <td><?= htmlspecialchars($data['nama_peralatan']); ?></td>
                <td><?= htmlspecialchars($data['jumlah']); ?></td>
                <td>
                  <span class="status-badge <?= $data['baik'] >= $data['jumlah'] * 0.7 ? 'status-good' : 'status-warning' ?>">
                    <?= htmlspecialchars($data['baik']); ?>
                  </span>
                </td>
                <td>
                  <div class="action-buttons">
                    <a href="editperalatan.php?id_peralatan=<?= urlencode($data['id_peralatan']); ?>" class="btn btn-edit">Edit</a>
                    <a href="hapusperalatan.php?id_peralatan=<?= urlencode($data['id_peralatan']); ?>" class="btn btn-delete" onclick="return confirm('Yakin ingin menghapus peralatan ini?');">Hapus</a>
                  </div>
                </td>
              </tr>
              <?php } ?>
            </tbody>
          </table>
        </div>

        <?php } ?>
      </div>
    </div>
  </div>

  <script>
    // Konfirmasi penghapusan dengan pesan yang lebih jelas
    document.addEventListener('DOMContentLoaded', function() {
      const deleteButtons = document.querySelectorAll('.btn-delete');
      deleteButtons.forEach(button => {
        button.addEventListener('click', function(e) {
          const namaPeralatan = this.closest('tr').querySelector('td:nth-child(2)').textContent;
          if (!confirm(Apakah Anda yakin ingin menghapus peralatan "${namaPeralatan}"?)) {
            e.preventDefault();
          }
        });
      });
    });
  </script>
</body>
</html>