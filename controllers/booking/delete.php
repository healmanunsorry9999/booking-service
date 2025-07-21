<?php
require_once '../../config/koneksi.php'; 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_booking = $_POST['id_booking'];

    // Hapus dari database
    $stmt = $conn->prepare("DELETE FROM bookings WHERE id = ?");
    $stmt->bind_param("i", $id_booking);

    if ($stmt->execute()) {
        echo "Hapus berhasil! <a href='../../views/booking.php'>Kembali ke halaman Booking</a>";
    } else {
        echo "Gagal menghapus booking: " . $stmt->error;
    }
    $stmt->close();
}
?>
