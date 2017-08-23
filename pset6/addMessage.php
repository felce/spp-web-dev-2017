<?php
session_start();
$author = $_SESSION['login'];
$text = htmlspecialchars($_POST['newMessage']);
date_default_timezone_set('Europe/Kiev');
$diffTime = strtotime('now');

if (strlen($text) > 1) {
    addNewMessageToDB($author, $text, $time, $diffTime);
}

function addNewMessageToDB($author, $text, $time, $diffTime)
{
    include ('connection_db.php');

    $connection = $_SESSION['connection'];
    $query = "INSERT INTO messages VALUES(NOW(),'$author', '$text', $diffTime)";
    $result = $connection->query($query);
}
