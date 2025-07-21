<?php
session_start();
include '../config/koneksi.php';

$username = $_POST['username'];
$password = $_POST['password'];

$query = $conn->query("SELECT * FROM users WHERE username = '".$username."'");
$user = $query->fetch_assoc();

$role_id = $user['id_role'];

$query = $conn->query("SELECT * FROM roles WHERE id = '".$user['id_role']."'");
$role = $query->fetch_assoc();

if ($user && password_verify($password, $user['password'])) {
    $_SESSION['id_user'] = $user['id'];
    $_SESSION['id_role'] = $user['id_role'];
    $_SESSION['role'] = $role['name'];
    $_SESSION['username'] = $user['username'];
    header('Location: ../views/dashboard.php');
} else {
    header('Location: ../views/login.php?error=1');
}
?>
