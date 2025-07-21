<?php
session_start();

// Jika user sudah login, redirect ke dashboard
if (isset($_SESSION['id_user'])) {
    header('Location: views/dashboard.php');
    exit;
}

// Jika belum login, redirect ke login
header('Location: views/login.php');
exit;
