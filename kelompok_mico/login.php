<?php
session_start();

// === Koneksi ke database ===
$host = 'localhost';
$user = 'root';
$pass = '';
$db   = 'laboran_db';

$conn = new mysqli($host, $user, $pass, $db);

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

$error = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $conn->real_escape_string($_POST['username']);
    $password = $_POST['password'];

    $sql = "SELECT * FROM admin WHERE username='$username' LIMIT 1";
    $result = $conn->query($sql);

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();

        // Ganti dengan password_verify jika pakai password hash
        if ($password === $user['password']) {
            $_SESSION['username'] = $username;
            header("Location: dashboard.php");
            exit;
        } else {
            $error = "Password salah!";
        }
    } else {
        $error = "Username tidak ditemukan!";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin - Sistem Laboran</title>
    <!-- Google Font & Icons -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <!-- External CSS -->
    <link rel="stylesheet" href="login.css">
</head>
<body>
    <div class="background-animation">
        <div class="floating-shape shape-1"></div>
        <div class="floating-shape shape-2"></div>
        <div class="floating-shape shape-3"></div>
    </div>

    <div class="login-container">
        <div class="login-header">
            <div class="logo">
                <i class="fas fa-flask"></i>
                <h1>Sistem Laboran</h1>
            </div>
            <h2>Login Admin</h2>
            <p>Masukkan kredensial Anda untuk mengakses sistem</p>
        </div>

        <?php if ($error): ?>
            <div class="error-message">
                <i class="fas fa-exclamation-circle"></i>
                <span><?= $error ?></span>
            </div>
        <?php endif; ?>

        <form method="POST" action="" class="login-form">
            <div class="form-group">
                <div class="input-with-icon">
                    <i class="fas fa-user"></i>
                    <input type="text" name="username" placeholder="Masukkan Username" autocomplete="off" required>
                </div>
            </div>
            
            <div class="form-group">
                <div class="input-with-icon">
                    <i class="fas fa-lock"></i>
                    <input type="password" name="password" placeholder="Masukkan Password" required>
                    <button type="button" class="toggle-password" id="togglePassword">
                        <i class="fas fa-eye"></i>
                    </button>
                </div>
            </div>

            <button type="submit" class="btn-login">
                <i class="fas fa-sign-in-alt"></i>
                Masuk ke Sistem
            </button>
        </form>

        <div class="login-footer">
            <div class="security-info">
                <i class="fas fa-shield-alt"></i>
                <span>Sistem Terjamin & Aman</span>
            </div>
            <div class="copyright">
                &copy; <?= date("Y") ?> Laboran Digital System
            </div>
        </div>
    </div>

    <script>
        // Toggle password visibility
        const togglePassword = document.getElementById('togglePassword');
        const passwordInput = document.querySelector('input[name="password"]');
        
        togglePassword.addEventListener('click', function() {
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);
            this.innerHTML = type === 'password' ? '<i class="fas fa-eye"></i>' : '<i class="fas fa-eye-slash"></i>';
        });

        // Add loading state to form submission
        document.querySelector('.login-form').addEventListener('submit', function(e) {
            const btn = this.querySelector('.btn-login');
            btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Memproses...';
            btn.disabled = true;
        });

        // Add focus effects
        const inputs = document.querySelectorAll('input');
        inputs.forEach(input => {
            input.addEventListener('focus', function() {
                this.parentElement.classList.add('focused');
            });
            
            input.addEventListener('blur', function() {
                if (!this.value) {
                    this.parentElement.classList.remove('focused');
                }
            });
        });
    </script>
</body>
</html>