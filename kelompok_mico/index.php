<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - Buku Digital Lab</title>
    <!-- Google Font & Icons -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <!-- External CSS -->
    <link rel="stylesheet" href="index.css">
</head>
<body>

<!-- Navbar Login -->
<nav class="navbar">
    <div class="nav-container">
        <div class="nav-brand">
            <i class="fas fa-flask"></i>
            <span>Buku Digital Lab</span>
        </div>
        <div class="nav-actions">
            <a href="login.php" class="login-btn">
                <i class="fas fa-sign-in-alt"></i>
                Login Admin
            </a>
        </div>
    </div>
</nav>

<!-- Main Content -->
<main class="main-content">
    <div class="hero-section">
        <div class="hero-content">
            <h1 class="hero-title">
                <i class="fas fa-microscope"></i>
                Sistem Manajemen Laboratorium
            </h1>
            <p class="hero-subtitle">Kelola data guru, siswa, kelas, dan peralatan lab dengan mudah dan efisien</p>
        </div>
    </div>

    <!-- Dashboard Grid -->
    <div class="dashboard-container">
        <div class="dashboard-grid">
            <!-- Guru Card -->
            <div class="card card-guru" onclick="location.href='form_guru.php'">
                <div class="card-icon">
                    <i class="fas fa-chalkboard-teacher"></i>
                </div>
                <div class="card-content">
                    <h3>Data Guru</h3>
                    <p>Kelola informasi dan kunjungan guru</p>
                </div>
                <div class="card-hover">
                    <span>Akses Data Guru</span>
                    <i class="fas fa-arrow-right"></i>
                </div>
            </div>

            <!-- Kelas Card -->
            <div class="card card-kelas" onclick="location.href='form_kelas.php'">
                <div class="card-icon">
                    <i class="fas fa-door-open"></i>
                </div>
                <div class="card-content">
                    <h3>Data Kelas</h3>
                    <p>Manajemen ruang kelas dan jadwal</p>
                </div>
                <div class="card-hover">
                    <span>Akses Data Kelas</span>
                    <i class="fas fa-arrow-right"></i>
                </div>
            </div>

            <!-- Siswa Card -->
            <div class="card card-siswa" onclick="location.href='form_siswa.php'">
                <div class="card-icon">
                    <i class="fas fa-user-graduate"></i>
                </div>
                <div class="card-content">
                    <h3>Data Siswa</h3>
                    <p>Kelola data siswa dan presensi</p>
                </div>
                <div class="card-hover">
                    <span>Akses Data Siswa</span>
                    <i class="fas fa-arrow-right"></i>
                </div>
            </div>

            <!-- Peralatan Lab Card -->
            <div class="card card-peralatan" onclick="location.href='peralatan.php'">
                <div class="card-icon">
                    <i class="fas fa-tools"></i>
                </div>
                <div class="card-content">
                    <h3>Peralatan Lab</h3>
                    <p>Inventaris dan maintenance alat lab</p>
                </div>
                <div class="card-hover">
                    <span>Akses Peralatan</span>
                    <i class="fas fa-arrow-right"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Features Section -->
    <section class="features-section">
        <div class="features-container">
            <div class="feature-item">
                <i class="fas fa-shield-alt"></i>
                <h4>Aman & Terpercaya</h4>
                <p>Sistem keamanan terjamin untuk data sensitif</p>
            </div>
            <div class="feature-item">
                <i class="fas fa-bolt"></i>
                <h4>Cepat & Responsif</h4>
                <p>Akses data dengan cepat kapan saja</p>
            </div>
            <div class="feature-item">
                <i class="fas fa-chart-line"></i>
                <h4>Analitik Real-time</h4>
                <p>Pantau statistik dan laporan terkini</p>
            </div>
        </div>
    </section>
</main>

<!-- Footer -->
<footer class="footer">
    <div class="footer-content">
        <p>&copy; 2024 Buku Digital Lab. All rights reserved.</p>
        <div class="footer-links">
            <a href="#"><i class="fas fa-info-circle"></i> Tentang</a>
            <a href="#"><i class="fas fa-envelope"></i> Kontak</a>
            <a href="#"><i class="fas fa-shield-alt"></i> Privasi</a>
        </div>
    </div>
</footer>

</body>
</html>