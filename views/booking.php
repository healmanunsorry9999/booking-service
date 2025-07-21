<?php
session_start();
include '../config/koneksi.php';
include '../includes/header.php';

if ($_SESSION['role'] == 'user') {

    $user_id = $_SESSION['id_user'];
    $booking_list = $conn->query("SELECT a.id, a.tanggal_service, a.status, a.catatan, b.username, c.nama_kendaraan, c.no_polisi, d.nama_service
        FROM bookings a
        LEFT JOIN users b ON a.id_user = b.id
        LEFT JOIN vehicles c ON a.id_vehicle = c.id
        LEFT JOIN services d ON a.id_service = d.id
        WHERE b.id = '$user_id'");
?>
    <h3>Form Booking</h3>
    <form method="POST" action="../controllers/booking/create.php">
        <label for="nama_kendaraan">Nama Kendaraan</label>
        <input type="text" name="nama_kendaraan" placeholder="Nama Kendaraan" required><br>

        <label for="no_polisi">NO Polisi</label>
        <input type="text" name="no_polisi" placeholder="No Polisi" required><br>

        <label for="tanggal_service">Tanggal Kunjungan</label>
        <input type="date" name="tanggal_service" required><br>

        <textarea name="catatan" placeholder="Catatan"></textarea><br>

        <label for="id_service">Layanan Service</label>
        <select name="id_service" required>
            <option value="">Pilih Layanan</option>
            <?php
            $service_list = $conn->query("SELECT * FROM services");
            while ($row = $service_list->fetch_assoc()) {
                echo "<option value='{$row['id']}'>{$row['nama_service']}</option>";
            }
            ?>
        </select><br>

        <button type="submit">Submit</button>
    </form>

    <br>

    <h3>Daftar Booking</h3>
    <table class="tbl">
        <tr>
            <th>User</th>
            <th>Kendaraan</th>
            <th>No Polisi</th>
            <th>Tanggal</th>
            <th>Nama Service</th>
            <th>Status</th>
            <th>Aksi</th>
        </tr>
        <?php while ($row = $booking_list->fetch_assoc()) : ?>
        <tr>
            <td><?= $row['username'] ?></td>
            <td><?= $row['nama_kendaraan'] ?></td>
            <td><?= $row['no_polisi'] ?></td>
            <td><?= $row['tanggal_service'] ?></td>
            <td><?= $row['nama_service'] ?></td>
            <td><?= $row['status'] ?></td>
            <td>
                <?php if ($row['status'] == 'pending') : ?>
                    <form method="POST" action="../controllers/booking/delete.php">
                        <input type="hidden" name="id_booking" value="<?= $row['id'] ?>">
                        <button type="submit">Hapus</button>
                    </form>
                <?php else: ?>
                    -
                <?php endif; ?>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>

<?php
} elseif ($_SESSION['role'] == 'admin') {
    $booking_list = $conn->query("SELECT a.id, a.tanggal_service, a.status, a.catatan, b.username, c.nama_kendaraan, c.no_polisi, d.nama_service
        FROM bookings a
        LEFT JOIN users b ON a.id_user = b.id
        LEFT JOIN vehicles c ON a.id_vehicle = c.id
        LEFT JOIN services d ON a.id_service = d.id");
?>
    <h3>Daftar Booking</h3>
    <table class="tbl">
        <tr>
            <th>User</th>
            <th>Kendaraan</th>
            <th>No Polisi</th>
            <th>Tanggal</th>
            <th>Nama Service</th>
            <th>Status</th>
            <th>Aksi</th>
        </tr>
        <?php while ($row = $booking_list->fetch_assoc()) : ?>
        <tr>
            <td><?= $row['username'] ?></td>
            <td><?= $row['nama_kendaraan'] ?></td>
            <td><?= $row['no_polisi'] ?></td>
            <td><?= $row['tanggal_service'] ?></td>
            <td><?= $row['nama_service'] ?></td>
            <td><?= $row['status'] ?></td>
            <td>
                <?php if ($row['status'] == 'pending') : ?>
                    <form method="POST" action="../controllers/booking/update.php">
                        <input type="hidden" name="confirm_id" value="<?= $row['id'] ?>">
                        <button type="submit">Konfirmasi</button>
                    </form>
                    <form method="POST" action="../controllers/booking/delete.php">
                        <input type="hidden" name="id_booking" value="<?= $row['id'] ?>">
                        <button type="submit">Hapus</button>
                    </form>
                <?php else: ?>
                    -
                <?php endif; ?>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>
<?php } ?>
<?php include '../includes/footer.php'; ?>
