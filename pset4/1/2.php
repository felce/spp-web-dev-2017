<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>stat</title>
</head>
<body>

<?php
  $sum = 0;
  for($i = -1000; $i <= 1000; $i++) {
    $str = "$i";
    if (substr("$str", -1) == "2" || substr("$str", -1) == "3" || substr("$str", -1) == "7") {
      $sum += $i;
    }
  }
  echo $sum;
?>
</body>
</html>
