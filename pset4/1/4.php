<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>4</title>
</head>
<style>
table {
  width: 630px; border: 0; border-spacing: 0; border-collapse: collapse;
}
.black {
  background-color: black;
}
</style>
<body>
  <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
    <input type="number" min="1" max="100" name="col" placeholder="number">
    <input type="number" min="1" max="100" name="row" placeholder="number">
    <input type="submit" value="do it!">
</form>

<?php

  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $col = $_POST["col"];
    $row = $_POST["row"];

    $height = 630/$row;

    echo "<table>";
    for ($i = 1; $i <= $col; $i++) {
      echo "<tr height='$height'>";
      for ($t = 1; $t <= $row; $t++) {
        if ($i%2==0 && $t%2 ==0){
          echo "<td class='black'></td>";
        } else if ($i%2!=0 && $t%2 !=0){
          echo "<td class='black'></td>";
        } else {
          echo "<td></td>";
        }
      }
      echo "</tr>";
    }
    echo "</table>";
}
?>
</body>
</html>
