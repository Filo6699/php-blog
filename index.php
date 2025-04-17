<?php
require __DIR__ . '/vendor/autoload.php';

use App\Model\Post;
use App\Repository\PostRepository;

$dataFile = __DIR__ . '/data/posts.json';
$repo     = new PostRepository($dataFile);
$errors   = [];

function create_post($title, $description) {
  global $repo, $errors;

  if ($title == "" || $description == "") {
    $errors[] = [
      'source'  => 'Post creation',
      'message' => 'Fill in all of the fields!',
    ];
    return;
  }

  if (strlen($title) > 64) {
    $errors[] = [
      'source'  => 'Post creation',
      'message' => 'The title is too long!',
    ];
    return;
  }
  if (strlen($description) > 1024) {
    $errors[] = [
      'source'  => 'Post creation',
      'message' => 'The description is too long!',
    ];
    return;
  }

  $newId    = count($repo->getAll()) + 1;
  $post     = new Post(
    $newId,
    $title,
    $description,
  );
  $repo->add($post);

  echo "Your post has been published! ID: $newId";
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $title = $_POST["title"];
  $description = $_POST["description"];

  create_post($title, $description);
}

foreach ($errors as $err) {
  echo "<div class=\"error\">";
  echo "<b>" . $err["source"] . "</b><br>";
  echo $err["message"];
  echo "</div>";
}

require __DIR__ . '/views/create_post.html';

foreach ($repo->getAll() as $p) {
    echo "<article>";
    echo "<h2>" . htmlspecialchars($p->getTitle()) . "</h2>";
    echo "<p>" . nl2br(htmlspecialchars($p->getContent())) . "</p>";
    echo "</article><hr>";
}
