<?php
require 'includes/db.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = $_SESSION['user_id'];
    $movie_id = $_POST['movie_id'];
    $rating = $_POST['rating'];
    $review = trim($_POST['review']);

    if ($movie_id && $rating && $review) {
        $stmt = $pdo->prepare("INSERT INTO reviews (user_id, movie_id, rating, review) VALUES (?, ?, ?, ?)");
        $stmt->execute([$user_id, $movie_id, $rating, $review]);
    }
}
header("Location: movie.php?id=$movie_id");
exit();
?>
