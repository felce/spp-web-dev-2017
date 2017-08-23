<?php
$host = 'localhost';
$db = 'easy_chat_db';
$un = 'root';
$pw = '';
$connection = new mysqli($host, $un, $pw, $db);

if ($connection->connect_error) {
    die($connection->connect_error);
}
else {
    $_SESSION['connection'] = $connection;
}
