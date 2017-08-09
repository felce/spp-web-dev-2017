<?php
  session_start();

  $mesFile = "messages0.json";
  $jsonMes = json_decode(file_get_contents($mesFile), true);

  $indexOfLastMessage = count($jsonMes);
  if( $_SESSION["indexOfLastMessage"] != $indexOfLastMessage){

    for ($i = $_SESSION["indexOfLastMessage"]; $i < count($jsonMes); $i++) {
      echo "<p>[", $jsonMes[$i]["time"],"] <b>",
            $jsonMes[$i]["author"], ":</b> ",
            $jsonMes[$i]["text"], "</p>";
    }
    $_SESSION["indexOfLastMessage"] = $indexOfLastMessage;
  }
?>
