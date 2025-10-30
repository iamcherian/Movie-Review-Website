<?php include __DIR__ . '/includes/header.php'; ?>
<h2>Sign Up</h2>
<form method="POST" action="signup_process.php">
    Username: <input type="text" name="username" required><br>
    Email: <input type="email" name="email" required><br>
    Password: <input type="password" name="password" required><br>
    <button type="submit">Sign Up</button>
</form>
<?php include __DIR__ . '/includes/footer.php'; ?>
