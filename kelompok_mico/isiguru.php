<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Data Guru - Sistem Manajemen</title>
  <!-- Google Font & Icons -->
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
  <!-- External CSS -->
  <link rel="stylesheet" href="isiguru.css">
</head>
<body>
  <div class="container">
    <div class="header">
      <a href="dashboard.php" class="btn-dashboard">
        <i class="fas fa-arrow-left"></i>
        Kembali ke Dashboard
      </a>
      <div class="header-content">
        <h1><i class="fas fa-chalkboard-teacher"></i> Data Guru</h1>
        <p>Kelola informasi dan data guru yang terdaftar dalam sistem</p>
      </div>
    </div>

    <?php
    include("koneksi.php");
    $sql = "SELECT * FROM guru ORDER BY nama_guru ASC";
    $hasil = mysqli_query($koneksi, $sql);

    if(!$hasil){
        die("Error Query :" . mysqli_error($koneksi));
    }

    $total_guru = mysqli_num_rows($hasil);
    ?>

    <div class="stats-container">
      <div class="stat-card">
        <div class="stat-icon">
          <i class="fas fa-users"></i>
        </div>
        <div class="stat-info">
          <h3><?php echo $total_guru; ?></h3>
          <p>Total Guru</p>
        </div>
      </div>
    </div>

    <div class="table-container">
      <div class="table-header">
        <div class="search-box">
          <i class="fas fa-search"></i>
          <input type="text" id="searchInput" placeholder="Cari guru...">
        </div>
      </div>

      <div class="table-wrapper">
        <table id="guruTable">
          <thead>
            <tr>
              <th class="text-center">No</th>
              <th>NIP</th>
              <th>Nama Guru</th>
              <th>Mata Pelajaran</th>
              <th class="text-center">Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php 
            $no = 1;
            while($data = mysqli_fetch_assoc($hasil)){ 
            ?>
            <tr>
              <td class="text-center"><?php echo $no++; ?></td>
              <td class="nip-cell">
                <i class="fas fa-id-card"></i>
                <?php echo htmlspecialchars($data['nip']); ?>
              </td>
              <td class="nama-cell">
                <div class="teacher-info">
                  <div class="teacher-avatar">
                    <i class="fas fa-user-tie"></i>
                  </div>
                  <div class="teacher-details">
                    <div class="teacher-name"><?php echo htmlspecialchars($data['nama_guru']); ?></div>
                  </div>
                </div>
              </td>
              <td>
                <span class="subject-badge"><?php echo htmlspecialchars($data['pelajaran']); ?></span>
              </td>
              <td class="text-center">
                <div class="action-buttons">
                  <a href="editguru.php?nip=<?php echo $data['nip']; ?>" class="btn-action btn-edit" title="Edit Data">
                    <i class="fas fa-edit"></i>
                  </a>
                  <a href="hapusguru.php?nip=<?php echo $data['nip']; ?>" 
                     class="btn-action btn-delete" 
                     onclick="return confirm('Anda yakin ingin menghapus data guru <?php echo addslashes($data['nama_guru']); ?>?');"
                     title="Hapus Data">
                    <i class="fas fa-trash"></i>
                  </a>
                </div>
              </td>
            </tr>
            <?php } ?>
          </tbody>
        </table>

        <?php if($total_guru == 0): ?>
        <div class="empty-state">
          <i class="fas fa-user-slash"></i>
          <h3>Belum Ada Data Guru</h3>
          <p>Silakan tambah data guru terlebih dahulu untuk mengelola informasi guru.</p>
        </div>
        <?php endif; ?>
      </div>
    </div>
  </div>

  <script>
    // Search functionality
    document.getElementById('searchInput').addEventListener('input', function(e) {
      const searchTerm = e.target.value.toLowerCase();
      const rows = document.querySelectorAll('#guruTable tbody tr');
      
      rows.forEach(row => {
        const text = row.textContent.toLowerCase();
        row.style.display = text.includes(searchTerm) ? '' : 'none';
      });
    });

    // Hover effects for table rows
    const tableRows = document.querySelectorAll('#guruTable tbody tr');
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
  </script>
</body>
</html>