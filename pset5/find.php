<?php
  session_start();
  $smile = '<img width="25" src="img/smile.png">';
  $sadSmile = '<img width="25" src="img/sadsmile.png">';
  $smiles = [':)', ':(', '(:', '):', '):'];
  $smilesImg = [$smile, $sadSmile, $smile, $sadSmile];


  $mesFile = 'messages0.json';
  $jsonMes = json_decode(file_get_contents($mesFile), true);

  $indexOfLastMessage = count($jsonMes);
  $indexOfLastMessageInSession =  $_SESSION['indexOfLastMessage'];
  if( $indexOfLastMessageInSession !== $indexOfLastMessage){

    for ($i = $indexOfLastMessageInSession; $i < $indexOfLastMessage; $i++) {
      $text = $jsonMes[$i]['text'];
      $text = str_replace($smiles, $smilesImg, $text);
      echo '<p>[', $jsonMes[$i]['time'],'] <b>',
            $jsonMes[$i]['author'], ':</b> ',
            $text, '</p>';
    }
    $_SESSION['indexOfLastMessage'] = $indexOfLastMessage;
  }
