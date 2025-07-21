<?php
require_once '../config/koneksi.php'; 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $password = $_POST['password'];
    $id_role = $_POST['id_role']; // '1' untuk admin atau '2' untuk user

    // Hash password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Simpan ke database
    $stmt = $conn->prepare("INSERT INTO users (username, password, id_role) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $username, $hashed_password, $id_role);

    if ($stmt->execute()) {
        echo "Registrasi berhasil! <a href='../views/login.php'>Login di sini</a>";
    } else {
        echo "Gagal mendaftar: " . $stmt->error;
    }
    $stmt->close();
}
?>