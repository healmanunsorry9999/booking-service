<?php
session_start();
include '../../config/koneksi.php';

if ($_SESSION['role'] === 'user') {
    $id_user = $_SESSION['id_user'];
    $nama_kendaraan = $_POST['nama_kendaraan'];
    $no_polisi = $_POST['no_polisi'];
    $tanggal_service = $_POST['tanggal_service'];
    $catatan = $_POST['catatan'];
    $id_service = $_POST['id_service'];
    $status = 'pending';

    #insert into vehicles
    $insert_vehicle = $conn->query("INSERT INTO vehicles (nama_kendaraan, id_user, no_polisi) 
                  VALUES ('$nama_kendaraan', '$id_user', '$no_polisi')");

    if (!$insert_vehicle) {
        header('Location: ../../views/booking.php?error=insert_vehicle_failed');
        exit();
    }

    #get id_vehicle
    $query = $conn->query("SELECT * FROM vehicles WHERE id_user = '$id_user' AND no_polisi = '$no_polisi'");
    if (!$query) {
        header('Location: ../../views/booking.php?error=get_vehicle_failed');
        exit();
    }
    $vehicle = $query->fetch_assoc();

    $id_vehicle = $vehicle['id'];

    #insert into bookings
    $insert_booking = $conn->query("INSERT INTO bookings (id_user, id_vehicle, id_service, tanggal_service, catatan, `status`) 
                  VALUES ('$id_user', '$id_vehicle', '$id_service', '$tanggal_service', '$catatan', '$status')");

    if (!$insert_booking) {
        header('Location: ../../views/booking.php?error=insert_booking_failed');
        exit();
    }

    header('Location: ../../views/booking.php?success=1');

} elseif ($_SESSION['role'] === 'admin' && isset($_POST['confirm_id'])) {

    $id = $_POST['confirm_id'];

    #update status
    $conn->query("UPDATE bookings SET status='confirmed' WHERE id='$id'");
    
    if (!$conn) {
        header('Location: ../../views/booking.php?error=update_booking_failed');
        exit();
    }

    header('Location: ../../views/booking.php?confirmed=1');

}
?>
