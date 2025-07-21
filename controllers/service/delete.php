<?php
require_once '../../config/koneksi.php'; 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_service = $_POST['id_service'];

    // Hapus dari database
    $stmt = $conn->prepare("DELETE FROM services WHERE id = ?");
    $stmt->bind_param("i", $id_service);

    if ($stmt->execute()) {
        echo "Hapus berhasil! <a href='../../views/service.php'>Kembali ke halaman Service</a>";
    } else {
        echo "Gagal menghapus service: " . $stmt->error;
    }
    $stmt->close();
}
?>