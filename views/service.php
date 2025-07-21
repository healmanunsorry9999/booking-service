<?php
session_start();
include '../config/koneksi.php';
include '../includes/header.php';

$service_list = $conn->query("SELECT * FROM services");
?>

<h2>Form tambah service</h2>
<form method="POST" action="../controllers/service/create.php">
    <label>Nama Service:</label><br>
    <input type="text" name="nama_service" required><br><br>
    
    <label>Deskripsi:</label><br>
    <textarea name="deskripsi" id="deskripsi" required></textarea>
    
    <br><br>

    <button type="submit">Submit</button>
</form>

<h3>Daftar Service</h3>
<table class="tbl">
    <tr>
        <th>Nama Service</th>
        <th>Deskripsi</th>
        <th>Aksi</th>
    </tr>
    <?php while ($row = $service_list->fetch_assoc()) : ?>
    <tr>
        <td><?= $row['nama_service'] ?></td>
        <td><?= $row['deskripsi'] ?></td>
        <td>

            <form method="POST" action="../controllers/service/delete.php">
                <input type="hidden" name="id_service" value="<?= $row['id'] ?>">
                <button type="submit">Delete</button>
            </form>
        </td>
    </tr>
    <?php endwhile; ?>
</table>

<?php include '../includes/footer.php'; ?>
