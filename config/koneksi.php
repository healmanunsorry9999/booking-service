<?php
$host = 'localhost';
$user = 'mysqluser';
$pass = 'Sorry.240106';
$db   = 'booking_service';

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
?>