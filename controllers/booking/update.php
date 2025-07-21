<?php
session_start();
include '../../config/koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['confirm_id'];
    $conn->query("UPDATE bookings SET status='confirmed' WHERE id='$id'");

    // Simpan ke database
    $stmt = $conn->prepare("UPDATE bookings SET status='confirmed' WHERE id=?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        echo "Konfirmasi berhasil! <a href='../../views/booking.php'>Kembali ke halaman Booking</a>";
    } else {
        echo "Gagal update konfirmasi: " . $stmt->error;
    }
    $stmt->close();
}
?>
