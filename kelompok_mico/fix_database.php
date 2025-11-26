<?php
include("koneksi.php");

$message = '';
$message_type = '';

if (isset($_POST['fix_database'])) {
    try {
        // Backup data sebelum perubahan
        $backup = mysqli_query($koneksi, "CREATE TABLE IF NOT EXISTS peralatan_backup AS SELECT * FROM peralatan");
        
        // Cek struktur tabel
        $check_table = mysqli_query($koneksi, "SHOW COLUMNS FROM peralatan LIKE 'id'");
        
        if(mysqli_num_rows($check_table) > 0) {
            // Jika kolom id sudah ada, ubah ke auto_increment
            $sql = "ALTER TABLE peralatan MODIFY id INT AUTO_INCREMENT PRIMARY KEY";
        } else {
            // Jika kolom id tidak ada, tambahkan
            $sql = "ALTER TABLE peralatan ADD id INT AUTO_INCREMENT PRIMARY KEY FIRST";
        }
        
        if(mysqli_query($koneksi, $sql)) {
            $message = "✅ Struktur database berhasil diperbaiki! Kolom id sekarang AUTO_INCREMENT.";
            $message_type = 'success';
        } else {
            throw new Exception(mysqli_error($koneksi));
        }
        
    } catch (Exception $e) {
        $message = "❌ Gagal memperbaiki database: " . $e->getMessage();
        $message_type = 'error';
    }
}

// Tampilkan struktur tabel saat ini
$current_structure = '';
$result = mysqli_query($koneksi, "DESCRIBE peralatan");
$current_structure .= "<div style='background: #f8f9fa; padding: 15px; border-radius: 8px; margin: 15px 0;'>";
$current_structure .= "<h3>Struktur Tabel Peralatan Saat Ini:</h3>";
$current_structure .= "<table border='1' style='width:100%; border-collapse:collapse; font-size:12px;'>";
$current_structure .= "<tr style='background:#e9ecef;'><th>Field</th><th>Type</th><th>Null</th><th>Key</th><th>Default</th><th>Extra</th></tr>";
while($row = mysqli_fetch_assoc($result)) {
    $current_structure .= "<tr>";
    $current_structure .= "<td>{$row['Field']}</td>";
    $current_structure .= "<td>{$row['Type']}</td>";
    $current_structure .= "<td>{$row['Null']}</td>";
    $current_structure .= "<td>{$row['Key']}</td>";
    $current_structure .= "<td>{$row['Default']}</td>";
    $current_structure .= "<td>{$row['Extra']}</td>";
    $current_structure .= "</tr>";
}
$current_structure .= "</table></div>";
?>
<!DOCTYPE html>
<html>
<head>
    <title>Perbaiki Database Peralatan</title>
    <style>
        body { 
            font-family: 'Poppins', sans-serif; 
            margin: 20px; 
            background: linear-gradient(135deg, #74b9ff, #a29bfe);
            min-height: 100vh;
        }
        .container { 
            max-width: 900px; 
            margin: 0 auto; 
            background: white;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.15);
        }
        .message { 
            padding: 15px; 
            margin: 15px 0; 
            border-radius: 8px; 
            border-left: 4px solid;
        }
        .success { 
            background: rgba(46, 204, 113, 0.1); 
            color: #27ae60; 
            border-left-color: #27ae60; 
        }
        .error { 
            background: rgba(231, 76, 60, 0.1); 
            color: #e74c3c; 
            border-left-color: #e74c3c; 
        }
        .btn { 
            padding: 12px 25px; 
            background: linear-gradient(135deg, #6c5ce7, #341f97);
            color: white; 
            border: none; 
            border-radius: 8px; 
            cursor: pointer; 
            font-family: 'Poppins', sans-serif;
            font-weight: 600;
            transition: 0.3s;
        }
        .btn:hover { 
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.2);
        }
        .back-link {
            display: inline-block;
            margin-top: 20px;
            color: #0984e3;
            text-decoration: none;
            font-weight: 600;
            padding: 10px 15px;
            border-radius: 8px;
            background: rgba(9, 132, 227, 0.1);
            transition: 0.3s;
        }
        .back-link:hover {
            background: #0984e3;
            color: white;
            text-decoration: none;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            padding: 10px;
            text-align: left;
            border: 1px solid #ddd;
        }
        th {
            background: #f2f2f2;
            font-weight: 600;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>🛠 Perbaiki Struktur Database Peralatan</h1>
        
        <?php if(!empty($message)): ?>
            <div class="message <?php echo $message_type; ?>">
                <?php echo $message; ?>
            </div>
        <?php endif; ?>
        
        <?php echo $current_structure; ?>
        
        <div style="background: #fff3cd; padding: 15px; border-radius: 8px; border-left: 4px solid #ffc107; margin: 20px 0;">
            <strong>⚠️ Perhatian:</strong> 
            Sebelum memperbaiki database, pastikan Anda telah membackup data. 
            Proses ini akan mengubah struktur tabel dan membuat backup otomatis.
        </div>
        
        <form method="post">
            <button type="submit" name="fix_database" class="btn">
                🔧 Perbaiki Struktur Database
            </button>
        </form>
        
        <a href="tambahperalatan.php" class="back-link">← Kembali ke Form Tambah Peralatan</a>
    </div>
</body>
</html>