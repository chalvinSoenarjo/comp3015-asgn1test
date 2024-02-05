<!DOCTYPE html>
<html>
<head>
    <title>News Aggregator</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<?php
// Read the contents of the JSON file
$json = file_get_contents('data/articles.json');
if ($json === false) {
    die('Error reading articles.json');
}

// Decode the JSON string into an array
$articles = json_decode($json, true);
if ($articles === null) {
    die('Error decoding articles.json');
}

// Include the navbar
include 'navbar.php';
?>
<div class="container">
    <h1>Latest Articles</h1>
    <ul>
        <?php foreach ($articles as $article): ?>
            <li>
                <h2><?= $article['title'] ?></h2>
                <a href="<?= $article['link'] ?>" target="_blank"><?= $article['link'] ?></a>
                <form action="edit_article.php" method="post">
                    <input type="hidden" name="id" value="<?= $article['id'] ?>">
                    <input type="submit" value="Edit">
                </form>
                <form action="index.php" method="post">
                    <input type="hidden" name="delete" value="<?= $article['id'] ?>">
                    <input type="submit" value="Delete">
                </form>
            </li>
            <li>
                <form action="edit_article.php" method="post">
                    <input type="hidden" name="id" value="<?= $article['id'] ?>">
                    <label for="edit_title_<?= $article['id'] ?>">Edit Title:</label>
                    <input type="text" id="edit_title_<?= $article['id'] ?>" name="title" value="<?= $article['title'] ?>" required><br>
                    <label for="edit_link_<?= $article['id'] ?>">Edit Link:</label>
                    <input type="url" id="edit_link_<?= $article['id'] ?>" name="link" value="<?= $article['link'] ?>" required><br>
                    <input type="submit" value="Save">
                </form>
            </li>
        <?php endforeach; ?>
    </ul>
</div>
</body>
</html>
