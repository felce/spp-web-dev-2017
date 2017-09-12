<?php
session_start();
date_default_timezone_set('Europe/Kiev');
include ('log-func.php');
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

$log = ' download messages from db';
logging($log);

$mesFile = 'messages0.json';
$jsonMes = json_decode(file_get_contents($mesFile), true);
$_SESSION['indexOfLastMessage'] = count($jsonMes);
for ($i = 0; $i < count($jsonMes); $i++) {
    $text = $jsonMes[$i]['text'];
    $text = str_replace($smiles, $smilesImg, $text);

    $currentTime         = time();
    $timeInPast          = $jsonMes[$i]['diffTime'];
    $differenceInMinutes = abs(($currentTime - $timeInPast) / 60);
    if ($differenceInMinutes < 60) {
        echo '<p>[', $jsonMes[$i]['time'], '] <b>', $jsonMes[$i]['author'], ':</b> ', $text, '</p>';
    }
}
