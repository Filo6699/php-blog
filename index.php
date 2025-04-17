<?php
require __DIR__ . '/vendor/autoload.php';

session_start();
if (!isset($_SESSION['username'])) {
  header('Location: login.php');
  exit;
}
$userUsername = $_SESSION['username'];

use App\Model\Post;
use App\Repository\PostRepository;

$dataFile = __DIR__ . '/data/posts.json';
$repo     = new PostRepository($dataFile);
$errors   = [];
$successMessage = '';

$title = '';
$description = '';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $title = $_POST["title"] ?? '';
    $description = $_POST["description"] ?? '';

    $validationErrors = Post::validate($title, $description);
    if (!empty($validationErrors)) {
        $errors = $validationErrors;
    } else {
        $newId = count($repo->getAll()) + 1;
        $post = new Post(
          id: $newId,
          title: $title,
          content: $description,
          author: $userUsername,
        );
        $repo->add($post);
        $successMessage = "Your post has been published!";
        $title = '';
        $description = '';
    }
}

if (!empty($errors)) {
    echo '<div class="errors"><b>errors!</b><ul>';
    foreach ($errors as $err) {
        echo "<li><b>{$err['source']}:</b> {$err['message']}</li>";
    }
    echo '</ul></div>';
}

if ($successMessage) {
    echo htmlspecialchars($successMessage);
    echo "<br>";
}

echo "your username: " . htmlspecialchars($userUsername);

require __DIR__ . '/views/create_post.php';

echo '<hr>';

foreach ($repo->getAll() as $p) {
    echo "<article>";
    echo "<h3>" . htmlspecialchars($p->getTitle()) . "</h3>";
    echo "Author: " . htmlspecialchars($userUsername);
    echo "<p>" . nl2br(htmlspecialchars($p->getContent())) . "</p>";
    echo "</article><hr>";
}
