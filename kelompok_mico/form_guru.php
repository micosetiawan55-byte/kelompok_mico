<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Buku Pengunjung</title>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

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

    a {
      color: #0984e3;
      text-decoration: none;
    }
    a:hover {
      text-decoration: underline;
    }

    label {
      font-weight: 600;
      color: #2d3436;
      display: block;
      margin-bottom: 5px;
    }

    .form-group {
      position: relative;
      margin-bottom: 20px;
    }

    input[type="text"],
    input[type="time"] {
      width: 100%;
      padding: 10px;
      border: 1px solid #dfe6e9;
      border-radius: 8px;
      outline: none;
      transition: 0.3s;
    }

    input[type="text"]:focus,
    input[type="time"]:focus {
      border-color: #6c5ce7;
      box-shadow: 0 0 8px rgba(108, 92, 231, 0.3);
    }

    button {
      padding: 10px 20px;
      border: none;
      color: #fff;
      font-weight: 600;
      border-radius: 8px;
      cursor: pointer;
      transition: 0.3s;
    }

    button:hover {
      transform: scale(1.05);
    }

    .btn-primary { background: #6c5ce7; }
    .btn-primary:hover { background: #341f97; }

    .btn-reset { background: #fd9644; }
    .btn-reset:hover { background: #e67e22; }

    .btn-secondary { background: #00cec9; }
    .btn-secondary:hover { background: #009688; }

    #suggestion {
      position: absolute;
      top: 100%;
      left: 0;
      right: 0;
      background: #fff;
      border: 1px solid #dfe6e9;
      border-radius: 8px;
      max-height: 150px;
      overflow-y: auto;
      box-shadow: 0 5px 15px rgba(0,0,0,0.1);
      display: none;
      z-index: 99;
    }

    #suggestion div {
      padding: 10px;
      cursor: pointer;
      transition: 0.2s;
    }

    #suggestion div:hover {
      background: #dfe6e9;
    }

    .top-link {
      display: block;
      margin-bottom: 15px;
      text-align: center;
    }

    .btn-group {
      margin-top: 20px; 
      text-align: center;
    }

    .btn-group button {
      margin: 0 5px;
    }
  </style>
</head>
<body>
  <div class="container">
    <h2>Form Buku Pengunjung - Guru</h2>

    <a class="top-link" href="index.php">← Kembali Ke Dashboard</a>

    <form action="simpan_guru.php" method="post" id="form_guru">
      
      <div class="form-group">
        <label>Nama Guru:</label>
        <input type="text" id="nama_guru" name="nama_guru" autocomplete="off" required>
        <div id="suggestion"></div>
      </div>

      <div class="form-group">
        <label>Kode Guru:</label>
        <input type="text" id="nip" name="nip" readonly>
      </div>

      <div class="form-group">
        <label>Pelajaran:</label>
        <input type="text" id="pelajaran" name="pelajaran" readonly>
      </div>

      <div class="form-group">
        <label>Kelas:</label>
        <input type="text" id="kelas_diajar" name="kelas_diajar" required>
      </div>

      <div class="form-group">
        <label>Jam Masuk:</label>
        <input type="time" id="jam_mulai" name="jam_mulai" required>
      </div>

      <div class="form-group">
        <label>Jam Selesai:</label>
        <input type="time" id="jam_selesai" name="jam_selesai" required>
      </div>

      <div class="btn-group">
        <button type="submit" class="btn-primary">💾 Simpan</button>
        <button type="reset" class="btn-reset">🔄 Reset</button>
        <button type="button" class="btn-secondary" onclick="window.location.href='tambahguru.php'">➕ Tambah Guru</button>
      </div>
    </form>
  </div>

  <script>
    $(document).ready(function(){
      $("#nama_guru").keyup(function(){
        var query = $(this).val();
        if(query != ""){
          $.ajax({
            url: "get_guru.php",
            method: "POST",
            data: {query:query},
            success:function(data){
              $("#suggestion").fadeIn();
              $("#suggestion").html(data);
            }
          });
        } else {
          $("#suggestion").fadeOut();
        }
      });

      $(document).on("click", ".pilih", function(){
        var kode_guru = $(this).data("nip");
        var nama_guru = $(this).data("nama_guru");
        var pelajaran = $(this).data("pelajaran");

        $("#nama_guru").val(nama_guru);
        $("#nip").val(kode_guru);
        $("#pelajaran").val(pelajaran);
        $("#suggestion").fadeOut();
      });
    });
  </script>
</body>
</html>
