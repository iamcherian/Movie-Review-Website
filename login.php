<?php include __DIR__ . '/includes/header.php'; ?>
<h2>Login</h2>
<form method="POST" action="login_process.php">
    Email: <input type="email" name="email" required><br>
    Password: <input type="password" name="password" required><br>
    <button type="submit">Login</button>
</form>
<?php include __DIR__ . '/includes/footer.php'; ?>