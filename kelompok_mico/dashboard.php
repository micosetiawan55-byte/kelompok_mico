<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Dashboard Admin</title>
  <link rel="stylesheet" href="dashboard.css" />
</head>
<body>

  <aside class="sidebar">
    <h2 class="logo">Dashboard</h2>
    <nav class="nav-menu">
      <a href="dashboard.php" class="active">📋 Dashboard</a>
      <a href="gurudiadmin.php">👩‍🏫 Guru</a>
      <a href="siswadiadmin.php">👨‍🎓 Siswa</a>
      <a href="kelasdiadmin.php">🏫 Kelas</a>
      <a href="peralatandiadmin.php">🛠️ Peralatan</a>
      <a href="logout.php">Logout</a>
    </nav>
  </aside>

  <main class="main-content">
    <h1>Dashboard Admin</h1>
    <div class="cards">
      <a href="isiguru.php" class="card">Guru</a>
      <a href="isisiswa.php" class="card">Siswa</a>
      <a href="isikelas.php" class="card">Kelas</a>
    </div>
  </main>

</body>
</html>