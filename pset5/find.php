<?php
  $mesFile = "messages0.json";
  $jsonMes = json_decode(file_get_contents($mesFile), true);

  for ($i = 0; $i < count($jsonMes); $i++){
    date_default_timezone_set('Europe/Kiev');
    $currentTime = strtotime("now");
    $timeInPast = $jsonMes[$i]["diffTime"];
    $differenceInMinutes = abs(($currentTime - $timeInPast)/60);
    if ($differenceInMinutes < 60){
        echo "<p>[", $jsonMes[$i]["time"],"] <b>", $jsonMes[$i]["author"], ":</b> ", $jsonMes[$i]["text"], "</p>";
      }
  }
?>
