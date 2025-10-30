<?php
session_start();
include 'includes/header.php';
require 'includes/db.php';
?>

<h2>Recent Reviews</h2>

<?php
$stmt = $pdo->query("
    SELECT 
        reviews.rating, 
        reviews.review, 
        reviews.created_at,
        users.username,
        movies.title,
        movies.id AS movie_id
    FROM reviews
    JOIN users ON reviews.user_id = users.id
    JOIN movies ON reviews.movie_id = movies.id
    ORDER BY reviews.created_at DESC
    LIMIT 20
");

$reviews = $stmt->fetchAll();

if ($reviews):
    foreach ($reviews as $r): ?>
        <div style="background:#f9f9f9; border:1px solid #ddd; padding:15px; margin:10px 0; border-radius:8px">
            <strong><?= htmlspecialchars($r['username']) ?></strong> reviewed 
            <a href="movie.php?id=<?= $r['movie_id'] ?>"><?= htmlspecialchars($r['title']) ?></a><br>
            <span>Rating: <?= $r['rating'] ?>/10</span><br><br>
            <em><?= nl2br(htmlspecialchars($r['review'])) ?></em>
        </div>
    <?php endforeach;
else:
    echo "<p>No reviews yet.</p>";
endif;
?>

<?php include 'includes/footer.php'; ?>