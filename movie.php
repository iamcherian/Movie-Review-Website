<?php
session_start();
include __DIR__ . '/includes/header.php';
require 'includes/db.php';

$movie_id = $_GET['id'] ?? 1;
$stmt = $pdo->prepare("SELECT * FROM movies WHERE id = ?");
$stmt->execute([$movie_id]);
$movie = $stmt->fetch();

if (!$movie) {
    echo "<p>Movie not found.</p>";
    include 'includes/footer.php';
    exit;
}
?>
<h2><?= htmlspecialchars($movie['title']) ?> (<?= $movie['year'] ?>)</h2>
<p><strong>Director:</strong> <?= htmlspecialchars($movie['director']) ?></p>
<p><?= htmlspecialchars($movie['description']) ?></p>
<img src="<?= htmlspecialchars($movie['poster_url']) ?>" width="200">
<hr>
<h3>Reviews</h3>
<?php
$stmt = $pdo->prepare("SELECT reviews.rating, reviews.review, users.username FROM reviews JOIN users ON reviews.user_id = users.id WHERE reviews.movie_id = ? ORDER BY reviews.created_at DESC");
$stmt->execute([$movie_id]);
$reviews = $stmt->fetchAll();

if ($reviews):
    foreach ($reviews as $r): ?>
        <div style="background:#f4f4f4;padding:10px;margin:10px 0;border-radius:5px">
            <strong><?= htmlspecialchars($r['username']) ?></strong> rated it <?= $r['rating'] ?>/10<br>
            <em><?= nl2br(htmlspecialchars($r['review'])) ?></em>
        </div>
    <?php endforeach;
else:
    echo "<p>No reviews yet.</p>";
endif;
?>

<?php if (isset($_SESSION['user_id'])): ?>
    <hr>
    <h3>Leave a Review</h3>
    <form method="POST" action="review_process.php">
        <input type="hidden" name="movie_id" value="<?= $movie_id ?>">
        <label>Rating (1–10):</label><br>
        <input type="number" name="rating" min="1" max="10" required><br><br>
        <label>Review:</label><br>
        <textarea name="review" rows="4" cols="50" required></textarea><br><br>
        <button type="submit">Submit Review</button>
    </form>
<?php else: ?>
    <p><a href="login.php">Log in</a> to leave a review.</p>
<?php endif; ?>
<?php include __DIR__ . '/includes/footer.php'; ?>
