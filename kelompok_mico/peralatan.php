<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Data Peralatan</title>

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
      max-width: 900px;
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
      margin-bottom: 20px;
      color: #2d3436;
    }

    a {
      display: inline-block;
      margin-bottom: 15px;
      color: #0984e3;
      text-decoration: none;
      font-weight: 600;
    }

    a:hover {
      text-decoration: underline;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 20px;
      border-radius: 10px;
      overflow: hidden;
    }

    th, td {
      padding: 12px 15px;
      text-align: center;
    }

    th {
      background: #6c5ce7;
      color: #fff;
    }

    tr:nth-child(even) {
      background: #f8f9fa;
    }

    tr:hover {
      background: #dfe6e9;
      transition: 0.3s;
    }

    td {
      color: #2d3436;
    }

    .top-link {
      text-align: center;
      display: block;
    }
  </style>
</head>
<body>
  <div class="container">
    <h2>Data Peralatan</h2>
    <a class="top-link" href="index.php">← Kembali Ke Dashboard</a>

    <?php
    include("koneksi.php");
    $sql="SELECT * FROM peralatan";
    $hasil=mysqli_query($koneksi, $sql);

    if(!$hasil){
        echo "Error Query :" . mysqli_error($koneksi);
    }
    ?>

    <table>
      <tr>
        <th>No</th>
        <th>Nama Peralatan</th>
        <th>Jumlah</th>
        <th>Baik</th>
      </tr>

      <?php while($data = mysqli_fetch_assoc($hasil)){ ?>
      <tr>
        <td><?php echo $data['id_peralatan']; ?></td>
        <td><?php echo $data['nama_peralatan']; ?></td>
        <td><?php echo $data['jumlah']; ?></td>
        <td><?php echo $data['baik']; ?></td>
      </tr>
      <?php } ?>
    </table>
  </div>
</body>
</html>
