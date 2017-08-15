<?php
session_start();
$author = $_SESSION['login'];
$text   = htmlspecialchars($_POST['newMessage']);
date_default_timezone_set('Europe/Kiev');
$time     = date('H:i:s');
$diffTime = strtotime('now');

if (strlen($text) > 1) {
    addNewMessageToDB($author, $text, $time, $diffTime);
}

function addNewMessageToDB($author, $text, $time, $diffTime) {
  $host = 'localhost';
  $db = 'easy_chat_db';
  $un = 'root';
  $pw = '';

  $connection = new mysqli($host, $un, $pw, $db);
  if ($connection->connect_error) {
    die($connection->connect_error);
  }

  $query = "INSERT INTO messages VALUES('$time','$author', '$text', $diffTime)";
  $result = $connection->query($query);
}
