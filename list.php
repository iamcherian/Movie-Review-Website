<?php
session_start();
include 'includes/header.php';
require 'includes/db.php';
?>

<h2>All Movies</h2>

<?php
$stmt = $pdo->query("SELECT * FROM movies ORDER BY year DESC");
$movies = $stmt->fetchAll();

if ($movies):
    foreach ($movies as $movie): ?>
        <div style="margin-bottom:20px; border-bottom:1px solid #ccc; padding-bottom:10px;">
            <h3>
                <a href="movie.php?id=<?= $movie['id'] ?>">
                    <?= htmlspecialchars($movie['title']) ?> (<?= $movie['year'] ?>)
                </a>
            </h3>
            <?php if (!empty($movie['poster_url'])): ?>
                <img src="<?= htmlspecialchars($movie['poster_url']) ?>" width="150" style="float:left; margin-right:10px;">
            <?php endif; ?>
            <p><strong>Director:</strong> <?= htmlspecialchars($movie['director']) ?></p>
            <p><?= htmlspecialchars($movie['description']) ?></p>
            <div style="clear:both;"></div>
        </div>
    <?php endforeach;
else:
    echo "<p>No movies found.</p>";
endif;
?>

<?php include 'includes/footer.php'; ?>
