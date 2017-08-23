<?php
session_start();
$smile = '<img width="25" src="img/smile.png">';
$sadSmile = '<img width="25" src="img/sadsmile.png">';
$smiles = [':)', ':(', '(:', '):', '):'];
$smilesImg = [$smile, $sadSmile, $smile, $sadSmile];
include ('connection_db.php');

$connection = $_SESSION['connection'];
$query = 'SELECT * FROM messages';
$messages = $connection->query($query);
$numrows = $messages->num_rows;
$indexOfLastMessage = $numrows;
$indexOfLastMessageInSession = $_SESSION['indexOfLastMessage'];

if ($indexOfLastMessageInSession !== $indexOfLastMessage) {
    for ($i = $indexOfLastMessageInSession; $i < $indexOfLastMessage; $i++) {
        $messages->data_seek($i);
        $messagesInfo = $messages->fetch_array(MYSQLI_ASSOC);
        $text = $messagesInfo['text'];
        $text = str_replace($smiles, $smilesImg, $text);
        echo '<p>[', $messagesInfo['time'], '] <b>', $messagesInfo['author'], ':</b> ', $text, '</p>';
    }

    $_SESSION['indexOfLastMessage'] = $indexOfLastMessage;
}

$messages->close();
$connection->close();
