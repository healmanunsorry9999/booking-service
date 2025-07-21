<!DOCTYPE html>
<html>
<head>
    <title>Booking Service</title>

    <style>
        .tbl, .tbl td, .tbl th {
            text-align: center;
            border-collapse: collapse; 
            border: 1px solid black;
        }
    </style>
</head>
<body>

<?php if (isset($_SESSION['id_user'])): ?>
    <a href="../views/logout.php">Logout</a><hr>

    <?php if ($_SESSION['role'] == 'admin') : ?>
        <a href="../views/booking.php">Kelola Booking</a>
        <a href="../views/service.php">Kelola Service</a>
    <?php else: ?>
        <a href="../views/booking.php">Booking Service</a>
    <?php endif; ?>

<?php endif; ?>
