<?php
session_start();
$smile     = '<img width="25" src="img/smile.png">';
$sadSmile  = '<img width="25" src="img/sadsmile.png">';
$smiles    = array(
    ':)',
    ':(',
    '(:',
    '):',
    '):'
);
$smilesImg = array(
    $smile,
    $sadSmile,
    $smile,
    $sadSmile
);

$host = 'localhost';
$db = 'easy_chat_db';
$un = 'root';
$pw = '';

$connection = new mysqli($host, $un, $pw, $db);
if ($connection->connect_error) {
    die($connection->connect_error);
}

$query = "SELECT * FROM messages";
$messages = $connection->query($query);

$numrows = $messages->num_rows;

$indexOfLastMessage          = $numrows;
$indexOfLastMessageInSession = $_SESSION['indexOfLastMessage'];

$_SESSION['indexOfLastMessage'] = $numrows;

for ($i = 0; $i < $numrows; $i++) {
    $messages->data_seek($i);
    $messagesInfo = $messages->fetch_array(MYSQLI_ASSOC);
    $text = $messagesInfo['text'];
    $text = str_replace($smiles, $smilesImg, $text);
    date_default_timezone_set('Europe/Kiev');
    $currentTime         = strtotime('now');
    $timeInPast          = $messagesInfo['diffTime'];
    $differenceInMinutes = abs(($currentTime - $timeInPast) / 60);
    if ($differenceInMinutes < 60) {
        echo '<p>[', $messagesInfo['time'], '] <b>', $messagesInfo['author'], ':</b> ', $text, '</p>';
    }
}

$messages->close();
$connection->close();
