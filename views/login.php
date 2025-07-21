<?php include '../includes/header.php'; ?>
<h2>Login</h2>
<form method="POST" action="../controllers/auth.php">
    <input type="text" name="username" required placeholder="Username"><br>
    <input type="password" name="password" required placeholder="Password"><br>
    <button type="submit">Login</button>
    <a href="../views/register.php" class="btn">Register</a>
</form>
<?php include '../includes/footer.php'; ?>
