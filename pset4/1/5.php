<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>stat</title>
</head>
<body>
  <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
    <input type="number" min="1" max="20000" name="number" placeholder="number">
    <input type="submit" value="do it!">
</form>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $number = $_POST['number'];
  $str = "$number";
  echo array_sum(str_split($str));
}
?>
</body>
</html>
