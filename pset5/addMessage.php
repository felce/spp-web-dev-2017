<?php
  session_start();
  $author = $_SESSION["login"];
  $text = $_POST["newMessage"];

  $time = date('H:i:s');
  $diffTime = strtotime("now");

  if ( strlen($text) > 1) {
    $len = strlen($text);
    for ($i = 0; $i < $len; $i++) {
      $len = strlen($text);
      if ($text[$i] == ":" && ($text[$i + 1] == ")" || $text[$i + 1] == "(")){
        $i=0;
        $text = findSmiles($text);
      }
    }
    addNewMessageToJson($author, $text, $time, $diffTime);
  }

  function findSmiles($text) {
    $smileIndex = strpos($text,":");
    if ($smileIndex !== false && $text[$smileIndex + 1] == ")"){
      return substr($text, 0, $smileIndex)."<img width='25' src='img/smile.png'>".substr($text, $smileIndex + 2);
    } else if ($smileIndex !== false && $text[$smileIndex + 1] == "("){
      return substr($text, 0, $smileIndex)."<img width='25' src='img/sadsmile.png'>".substr($text, $smileIndex+2);
    } else {
      return $text;
    }
  }

  function addNewMessageToJson($author, $text, $time,$diffTime){
    $mesFile = "messages0.json";
    $jsonMessages = json_decode(file_get_contents($mesFile), true);
    $index = count($jsonMessages);

    $jsonMessages[$index]["time"] = $time;
    $jsonMessages[$index]["author"] = $author;
    $jsonMessages[$index]["text"] = $text;
    $jsonMessages[$index]["diffTime"] = $diffTime;
    $newJsonString = json_encode($jsonMessages);
    file_put_contents($mesFile, $newJsonString);
  }
?>
