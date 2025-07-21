<?php
require_once '../../config/koneksi.php'; 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_service = $_POST['id_service'];

    // update data service
    $nama_service = $_POST['nama_service'];
    $deskripsi = $_POST['deskripsi'];
    
    // Simpan ke database
    $stmt = $conn->prepare("UPDATE services SET nama_service = ?, deskripsi = ? WHERE id = ?");
    $stmt->bind_param("ssi", $nama_service, $deskripsi, $id_service);

    if ($stmt->execute()) {
        echo "Update berhasil! <a href='../../views/service.php'>Kembali ke halaman Service</a>";
    } else {
        echo "Gagal update service: " . $stmt->error;
    }
    $stmt->close();
}
?>