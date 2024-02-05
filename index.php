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

// Check if the file is empty or does not exist
if (empty($json)) {
    // Write [] to the file
    file_put_contents('data/articles.json', '[]');
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
                <form action="delete_article.php" method="post">
                    <input type="hidden" name="id" value="<?= $article['id'] ?>">
                    <input type="submit" value="Delete">
                </form>
            </li>
        <?php endforeach; ?>
    </ul>
</div>
</body>
</html>
