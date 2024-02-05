<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $link = $_POST['link'];

    // Validate inputs
    // ...

    // Save to JSON file
    $json = file_get_contents('data/articles.json');
    if ($json === false) {
        die('Error reading articles.json');
    }
    $articles = json_decode($json, true);
    if ($articles === null) {
        die('Error decoding articles.json');
    }

    $id = time(); // Generate ID
    $article = ['id' => $id, 'title' => $title, 'link' => $link];
    $articles[] = $article;

    $success = file_put_contents('data/articles.json', json_encode($articles));
    if ($success === false) {
        die('Error writing articles.json');
    }

    // Redirect to index.php
    header('Location: index.php');
    exit();
}
?>
