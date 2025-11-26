<?php
include("koneksi.php");

if (isset($_GET['kode_kelas'])) {
    $id = $_GET['kode_kelas'];
    
    // Validasi yang lebih fleksibel
    if (empty($id) || strlen($id) > 10) {
        die("ID tidak valid: Panjang maksimal 10 karakter");
    }
    
    // Bersihkan input
    $id = trim($id);
    
    // Gunakan prepared statement
    $stmt = mysqli_prepare($koneksi, "DELETE FROM kelas WHERE kode_kelas = ?");
    
    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "s", $id);
        
        if (mysqli_stmt_execute($stmt)) {
            header("Location: isikelas.php");
            exit;
        } else {
            echo "Gagal menghapus data: " . mysqli_error($koneksi);
        }
        
        mysqli_stmt_close($stmt);
    } else {
        echo "Error dalam prepared statement: " . mysqli_error($koneksi);
    }
} else {
    echo "ID tidak ditemukan";
}
?>