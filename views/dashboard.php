<?php
session_start();
if (!isset($_SESSION['role'])) header('Location: login.php');
include '../includes/header.php';
?>
<h2>Dashboard - <?= $_SESSION['role'] ?></h2>
<?php include '../includes/footer.php'; ?>
