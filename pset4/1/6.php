<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>stat</title>
</head>
<body>

<?php

$arr = array();

$arr = reverseArray(sortArray(deleteRepeats(init($arr))));

function init($arr) {
  echo "<b>array: </b>";
  for ($i = 0; $i < 100; $i++) {
    echo $arr[$i] = rand(1, 10), " ";
  }
  echo "<br><br>";
  return $arr;
}

function deleteRepeats($arr) {
  echo "<b>array without repeats: </b>";
  $index = 0;
  for ($i = 1; $i <= 10; $i++) {
    for ($k = 0; $k < count($arr); $k++) {
      if ($arr[$k] == $i && $index == 0) {
        $index++;
      } else if ($arr[$k] == $i && $index != 0){
        array_splice($arr, $k, 1);
        $k--;
      }
    }
    $index = 0;
  }
  for ($i = 0; $i < count($arr); $i++) {
    echo $arr[$i], " ";
  }
  echo "<br><br>";
  return $arr;
}

function sortArray($arr) {
  echo "<b>sort array: </b>";
  sort($arr);
  for ($i = 0; $i < count($arr); $i++) {
    echo $arr[$i], " ";
  }
  echo "<br><br>";
  return $arr;
}

function reverseArray($arr) {
  echo "<b>revers array: </b>";
  $arr = array_reverse($arr);
  for ($i = 0; $i < count($arr); $i++) {
    echo $arr[$i], " ";
  }
  return $arr;
}

?>
</body>
</html>
