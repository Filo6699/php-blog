<?php

if ($_SERVER['REQUEST_METHOD'] === "POST") {
  $username = $_POST["username"];
  
  $usernameLength = strlen($username);
  if ($usernameLength < 2 || $usernameLength > 32) {
    echo 'no u silly<br>username shulod be from 2 chars to 32 chars';
  } else {
    session_start();
    $_SESSION['username'] = $username;
    header('Location: index.php');
    exit();
  }
}

require __DIR__ . "/views/login.php";
