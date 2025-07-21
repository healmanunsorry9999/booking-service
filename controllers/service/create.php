<?php
require_once '../../config/koneksi.php'; 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama_service = $_POST['nama_service'];
    $deskripsi = $_POST['deskripsi'];
    
    // Simpan ke database
    $stmt = $conn->prepare("INSERT INTO services (nama_service, deskripsi) VALUES (?, ?)");
    $stmt->bind_param("ss", $nama_service, $deskripsi);

    if ($stmt->execute()) {
        echo "Tambah service berhasil! <a href='../../views/service.php'>Kembali ke halaman Service</a>";
    } else {
        echo "Gagal menambahkan service: " . $stmt->error;
    }
    $stmt->close();
}
?>