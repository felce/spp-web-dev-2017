<?php
session_start();
$author = $_SESSION['login'];
$text   = htmlspecialchars($_POST['newMessage']);
date_default_timezone_set('Europe/Kiev');
$time     = date('H:i:s');
$diffTime = strtotime('now');

if (strlen($text) > 1) {
    addNewMessageToJson($author, $text, $time, $diffTime);
}

function addNewMessageToJson($author, $text, $time, $diffTime) {
    $mesFile      = 'messages0.json';
    $jsonMessages = json_decode(file_get_contents($mesFile), true);
    $index        = count($jsonMessages);

    $jsonMessages[$index]['time']     = $time;
    $jsonMessages[$index]['author']   = $author;
    $jsonMessages[$index]['text']     = $text;
    $jsonMessages[$index]['diffTime'] = $diffTime;
    $newJsonString                    = json_encode($jsonMessages, JSON_PRETTY_PRINT);
    file_put_contents($mesFile, $newJsonString);
}
