<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>stat</title>
</head>
<style>
  body{
    text-align: center;
    background-color: lightgray;
    font-size: 300%;
    color: white;
    opacity: 0.6;
  }
  h1, div {
    margin: 10px auto;
  }
</style>
<body>
  <h1>Your choice is: <?php echo $_POST["choise"]; ?> </h1>
  <p>thank you</p>

<?php

$can = true;

$name = $_POST["name"];
$fileNames = "names.json";
$jsonNames = json_decode(file_get_contents($fileNames), true);
$index = 0;
foreach ($jsonNames as $value){
  if ($value == $name){
    $can = false;
  }
  $index++;
}
if ($can) {
  $jsonNames[$index+1] = $name;
  $newNames = json_encode($jsonNames);
  file_put_contents($fileNames, $newNames);
$choise = $_POST["choise"];
$file = "stat.json";

$json = json_decode(file_get_contents($file), true);

  if ($choise == 'tabs') {
    $json['tabs']++;
  }
  if ($choise == 'spaces') {
    $json['spaces']++;
  }

$newJsonString = json_encode($json);
file_put_contents($file, $newJsonString);
}
?>
  <div id="piechart" style="width: 900px; height: 300px;"></div>

  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
  <script type="text/javascript" >
    function readTextFile(file, callback) {
      var rawFile = new XMLHttpRequest();

      var tabs, spaces, iach;
      rawFile.overrideMimeType("application/json");
      rawFile.open("GET", file, true);
      rawFile.onreadystatechange = function() {
          if (rawFile.readyState === 4 && rawFile.status == "200") {
              callback(rawFile.responseText);
          }
      }
      rawFile.send(null);
    }

    readTextFile("stat.json", function(text){
        var data = JSON.parse(text);
        tabs = data.tabs;
        spaces = data.spaces;
    });

    google.charts.load('current', {'packages':['corechart']});
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {
      var data = google.visualization.arrayToDataTable([
        ['Task', 'Tabs or Spaces'],
        ['tabs',          tabs],
        ['spaces',        spaces],
      ]);

      var options = {
        title: ''
      };

      var chart = new google.visualization.PieChart(document.getElementById('piechart'));
      chart.draw(data, options);
    }
  </script>
</body>
</html>
