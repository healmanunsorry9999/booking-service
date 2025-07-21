<?php include '../includes/header.php'; ?>
<h2>Form Registrasi</h2>
<form method="POST" action="../controllers/register.php">
    <label>Username:</label><br>
    <input type="text" name="username" required><br><br>

    <label>Password:</label><br>
    <input type="password" name="password" required><br><br>


    <?php
    require_once '../config/koneksi.php';

    // Check if there are any users with admin role (id_role = 1)
    $stmt = $conn->prepare("SELECT COUNT(*) FROM users WHERE id_role = 1");
    $stmt->execute();
    $stmt->bind_result($adminCount);
    $stmt->fetch();
    $stmt->close();

    if ($adminCount == 0) {
        // No admin found, allow role selection and remove hidden input
        $role_input = '<label for="id_role">Role:</label><br>';
        $role_input .= '<select name="id_role" required>';
        $role_input .= '    <option value="1">Admin</option>';
        $role_input .= '    <option value="2">User</option>';
        $role_input .= '</select><br><br>';
        
        echo $role_input;
    } else {
        // Admin exists, hide role selection
        echo '<input type="hidden" name="id_role" value="2"> <!-- Default to User role -->';
    }
    ?>
    <button type="submit">Register</button>
    <a href="../views/login.php" class="btn">Login</a>
</form>
<?php include '../includes/footer.php'; ?>
