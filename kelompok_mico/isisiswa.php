<?php
include("koneksi.php");
$sql = "SELECT * FROM siswa ORDER BY nama_siswa ASC";
$hasil = mysqli_query($koneksi, $sql);

if (!$hasil) {
    die("Error Query :" . mysqli_error($koneksi));
}

$total_siswa = mysqli_num_rows($hasil);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Siswa - Sistem Manajemen</title>
    <!-- Google Font & Icons -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <!-- External CSS -->
    <link rel="stylesheet" href="isisiswa.css">
</head>
<body>
    <div class="container">
        <div class="header">
            <a href="dashboard.php" class="btn-dashboard">
                <i class="fas fa-arrow-left"></i>
                Kembali ke Dashboard
            </a>
            <div class="header-content">
                <h1><i class="fas fa-user-graduate"></i> Data Siswa</h1>
                <p>Kelola informasi siswa dan data kelas</p>
            </div>
        </div>

        <div class="stats-container">
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-users"></i>
                </div>
                <div class="stat-info">
                    <h3><?php echo $total_siswa; ?></h3>
                    <p>Total Siswa</p>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-layer-group"></i>
                </div>
                <div class="stat-info">
                    <h3>
                        <?php
                        $sql_kelas = "SELECT COUNT(DISTINCT kelas) as total_kelas FROM siswa";
                        $result_kelas = mysqli_query($koneksi, $sql_kelas);
                        $total_kelas = mysqli_fetch_assoc($result_kelas)['total_kelas'] ?? 0;
                        echo $total_kelas;
                        ?>
                    </h3>
                    <p>Kelas Terdaftar</p>
                </div>
            </div>
        </div>

        <div class="table-container">
            <div class="table-header">
                <div class="search-box">
                    <i class="fas fa-search"></i>
                    <input type="text" id="searchInput" placeholder="Cari siswa...">
                </div>
            </div>

            <div class="table-wrapper">
                <table id="siswaTable">
                    <thead>
                        <tr>
                            <th class="text-center">No</th>
                            <th>NIS</th>
                            <th>Nama Siswa</th>
                            <th>Kelas</th>
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
                            <td class="nis-cell">
                                <i class="fas fa-id-card"></i>
                                <?php echo htmlspecialchars($data['nis']); ?>
                            </td>
                            <td class="nama-cell">
                                <div class="student-info">
                                    <div class="student-avatar">
                                        <i class="fas fa-user-graduate"></i>
                                    </div>
                                    <div class="student-details">
                                        <div class="student-name"><?php echo htmlspecialchars($data['nama_siswa']); ?></div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <span class="class-badge"><?php echo htmlspecialchars($data['kelas']); ?></span>
                            </td>
                            <td class="text-center">
                                <div class="action-buttons">
                                    <a href="editsiswa.php?nis=<?php echo $data['nis']; ?>" 
                                       class="btn-action btn-edit" 
                                       title="Edit Siswa">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <a href="hapussiswa.php?nis=<?php echo $data['nis']; ?>" 
                                       class="btn-action btn-delete"
                                       onclick="return confirm('Anda yakin ingin menghapus siswa <?php echo addslashes($data['nama_siswa']); ?>?')"
                                       title="Hapus Siswa">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>

                <?php if($total_siswa == 0): ?>
                <div class="empty-state">
                    <i class="fas fa-user-slash"></i>
                    <h3>Belum Ada Data Siswa</h3>
                    <p>Silakan tambah data siswa terlebih dahulu untuk mengelola informasi siswa.</p>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <script>
        // Search functionality
        document.getElementById('searchInput').addEventListener('input', function(e) {
            const searchTerm = e.target.value.toLowerCase();
            const rows = document.querySelectorAll('#siswaTable tbody tr');
            
            rows.forEach(row => {
                const text = row.textContent.toLowerCase();
                row.style.display = text.includes(searchTerm) ? '' : 'none';
            });
        });

        // Hover effects for table rows
        const tableRows = document.querySelectorAll('#siswaTable tbody tr');
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