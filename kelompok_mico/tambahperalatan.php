<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Form Tambah Peralatan</title>

  <!-- Google Font -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">

  <style>
    body {
      font-family: 'Poppins', sans-serif;
      background: linear-gradient(135deg, #74b9ff, #a29bfe);
      margin: 0;
      padding: 0;
    }

    .container {
      max-width: 600px;
      margin: 50px auto;
      background: #fff;
      padding: 30px;
      border-radius: 15px;
      box-shadow: 0 10px 25px rgba(0,0,0,0.15);
      animation: fadeIn 0.7s ease-in-out;
    }

    @keyframes fadeIn {
      from {opacity: 0; transform: translateY(20px);}
      to {opacity: 1; transform: translateY(0);}
    }

    h2 {
      text-align: center;
      color: #2d3436;
      margin-bottom: 20px;
    }

    label {
      font-weight: 600;
      color: #2d3436;
      display: block;
      margin-bottom: 5px;
    }

    .form-group {
      margin-bottom: 20px;
    }

    input[type="text"],
    input[type="number"] {
      width: 100%;
      padding: 10px;
      border: 1px solid #dfe6e9;
      border-radius: 8px;
      outline: none;
      transition: 0.3s;
      font-family: 'Poppins', sans-serif;
    }

    input:focus {
      border-color: #6c5ce7;
      box-shadow: 0 0 8px rgba(108, 92, 231, 0.3);
    }

    .btn-group {
      text-align: center;
      margin-top: 20px;
    }

    button {
      padding: 10px 20px;
      border: none;
      color: #fff;
      font-weight: 600;
      border-radius: 8px;
      cursor: pointer;
      transition: 0.3s;
      margin: 0 5px;
    }

    button:hover {
      transform: scale(1.05);
    }

    .btn-primary { background: #6c5ce7; }
    .btn-primary:hover { background: #341f97; }

    .btn-reset { background: #fd9644; }
    .btn-reset:hover { background: #e67e22; }

    .top-link {
      display: block;
      margin-bottom: 15px;
      text-align: center;
      color: #0984e3;
      text-decoration: none;
      font-weight: 600;
    }
    .top-link:hover {
      text-decoration: underline;
    }
  </style>
</head>
<body>
  <div class="container">
    <?php
    include("koneksi.php");

    if (isset($_POST['simpan'])) {
        $nama_peralatan = $_POST['nama_peralatan'];
        $jumlah = $_POST['jumlah'];
        $baik = $_POST['baik'];

        $sql = "INSERT INTO peralatan (nama_peralatan, jumlah, baik) 
                VALUES ('$nama_peralatan', '$jumlah', '$baik')";
        $query = mysqli_query($koneksi, $sql);

        if ($query) {
            header("Location: peralatandiadmin.php");
            exit;
        } else {
            echo "<p style='color:red; text-align:center;'>❌ Gagal menambahkan data: " . mysqli_error($koneksi) . "</p>";
        }
    }
    ?>

    <h2>Tambah Peralatan Baru</h2>
    <a class="top-link" href="peralatandiadmin.php">← Kembali ke Data Peralatan</a>

    <form action="" method="post">
      <div class="form-group">
        <label for="nama_peralatan">Nama Peralatan</label>
        <input type="text" name="nama_peralatan" id="nama_peralatan" required>
      </div>

      <div class="form-group">
        <label for="jumlah">Jumlah</label>
        <input type="number" name="jumlah" id="jumlah" required>
      </div>

      <div class="form-group">
        <label for="baik">Baik</label>
        <input type="text" name="baik" id="baik" required>
      </div>

      <div class="btn-group">
        <button type="submit" name="simpan" class="btn-primary">💾 Simpan</button>
        <button type="reset" class="btn-reset">🔄 Reset</button>
      </div>
    </form>
  </div>
</body>
</html>
