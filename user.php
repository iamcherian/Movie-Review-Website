<?php
session_start();
include 'includes/header.php';
require 'includes/db.php';

$user_id = $_SESSION['user_id'];
$stmt = $pdo->prepare("SELECT username FROM users WHERE id = ?");
$stmt->execute([$user_id]);
$user = $stmt->fetch();

echo "<h2>Welcome, " . htmlspecialchars($user['username']) . "</h2>";

$stmt = $pdo->prepare("
    SELECT 
        reviews.rating,
        reviews.review,
        reviews.created_at,
        movies.title,
        movies.id AS movie_id,
        users.username
    FROM reviews
    JOIN movies ON reviews.movie_id = movies.id
    JOIN users ON reviews.user_id = users.id
    WHERE reviews.user_id = ?
    ORDER BY reviews.created_at DESC
");
$stmt->execute([$user_id]);
$reviews = $stmt->fetchAll();

echo "<h3>Your Reviews</h3>";

if ($reviews):
    foreach ($reviews as $r): ?>
        <div style="background:#f0f0f0; padding:10px; margin:10px 0; border-radius:5px;">
            <strong><?= htmlspecialchars($r['username']) ?></strong> reviewed 
            <a href="movie.php?id=<?= $r['movie_id'] ?>">
                <?= htmlspecialchars($r['title']) ?>
            </a><br>
            Rating: <?= $r['rating'] ?>/10<br>
            <em><?= nl2br(htmlspecialchars($r['review'])) ?></em>
        </div>
    <?php endforeach;
else:
    echo "<p>You haven't written any reviews yet.</p>";
endif;

include 'includes/footer.php';
?>
