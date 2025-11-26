<?php
include("koneksi.php");
$sql = "SELECT * FROM kelas ORDER BY kode_kelas ASC";
$hasil = mysqli_query($koneksi, $sql);

if (!$hasil) {
    die("Error Query :" . mysqli_error($koneksi));
}

$total_kelas = mysqli_num_rows($hasil);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Kelas - Sistem Manajemen</title>
    <!-- Google Font & Icons -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <!-- External CSS -->
    <link rel="stylesheet" href="isikelas.css">
</head>
<body>
    <div class="container">
        <div class="header">
            <a href="dashboard.php" class="btn-dashboard">
                <i class="fas fa-arrow-left"></i>
                Kembali ke Dashboard
            </a>
            <div class="header-content">
                <h1><i class="fas fa-door-open"></i> Data Kelas</h1>
                <p>Kelola informasi kelas dan jumlah siswa</p>
            </div>
        </div>

        <div class="stats-container">
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-door-open"></i>
                </div>
                <div class="stat-info">
                    <h3><?php echo $total_kelas; ?></h3>
                    <p>Total Kelas</p>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-users"></i>
                </div>
                <div class="stat-info">
                    <h3>
                        <?php
                        $sql_total = "SELECT SUM(jumlah_siswa) as total_siswa FROM kelas";
                        $result_total = mysqli_query($koneksi, $sql_total);
                        $total_siswa = mysqli_fetch_assoc($result_total)['total_siswa'] ?? 0;
                        echo $total_siswa;
                        ?>
                    </h3>
                    <p>Total Siswa</p>
                </div>
            </div>
        </div>

        <div class="table-container">
            <div class="table-header">
                <div class="search-box">
                    <i class="fas fa-search"></i>
                    <input type="text" id="searchInput" placeholder="Cari kelas...">
                </div>
            </div>

            <div class="table-wrapper">
                <table id="kelasTable">
                    <thead>
                        <tr>
                            <th class="text-center">No</th>
                            <th>Kode Kelas</th>
                            <th>Nama Kelas</th>
                            <th class="text-center">Jumlah Siswa</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $no = 1;
                        while ($data = mysqli_fetch_assoc($hasil)) { 
                        ?>
                        <tr>
                            <td class="text-center"><?php echo $no++; ?></td>
                            <td class="kode-cell">
                                <i class="fas fa-hashtag"></i>
                                <?php echo htmlspecialchars($data['kode_kelas']); ?>
                            </td>
                            <td class="nama-cell">
                                <div class="class-info">
                                    <div class="class-avatar">
                                        <i class="fas fa-chalkboard"></i>
                                    </div>
                                    <div class="class-details">
                                        <div class="class-name"><?php echo htmlspecialchars($data['nama_kelas']); ?></div>
                                    </div>
                                </div>
                            </td>
                            <td class="text-center">
                                <span class="student-count"><?php echo htmlspecialchars($data['jumlah_siswa']); ?></span>
                                <small>siswa</small>
                            </td>
                            <td class="text-center">
                                <div class="action-buttons">
                                    <a href="editkelas.php?kode_kelas=<?php echo $data['kode_kelas']; ?>" 
                                       class="btn-action btn-edit" 
                                       title="Edit Kelas">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <a href="hapuskelas.php?kode_kelas=<?php echo $data['kode_kelas']; ?>" 
                                       class="btn-action btn-delete"
                                       onclick="return confirm('Anda yakin ingin menghapus kelas <?php echo addslashes($data['nama_kelas']); ?>?')"
                                       title="Hapus Kelas">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>

                <?php if($total_kelas == 0): ?>
                <div class="empty-state">
                    <i class="fas fa-door-closed"></i>
                    <h3>Belum Ada Data Kelas</h3>
                    <p>Silakan tambah data kelas terlebih dahulu untuk mengelola informasi kelas.</p>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <script>
        // Search functionality
        document.getElementById('searchInput').addEventListener('input', function(e) {
            const searchTerm = e.target.value.toLowerCase();
            const rows = document.querySelectorAll('#kelasTable tbody tr');
            
            rows.forEach(row => {
                const text = row.textContent.toLowerCase();
                row.style.display = text.includes(searchTerm) ? '' : 'none';
            });
        });

        // Hover effects for table rows
        const tableRows = document.querySelectorAll('#kelasTable tbody tr');
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