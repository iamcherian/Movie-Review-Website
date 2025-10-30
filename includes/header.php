<!DOCTYPE html>
<html>
<head>
    <title>CineLog</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<nav>
    <a href="index.php">Home</a>
    <a href="feed.php">Feed</a>
    <a href="list.php">Movies</a>
    <?php if (isset($_SESSION['user_id'])): ?>
        <a href="user.php">Profile</a>
        <a href="logout.php">Logout</a>
    <?php else: ?>
        <a href="login.php">Login</a>
        <a href="signup.php">Signup</a>
    <?php endif; ?>
</nav>
<hr>

