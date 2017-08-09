<?php
  $login = "";
  $pass = "";
  $errLogin = "";
  $errPass = "";
  session_start();
  if (isset($_POST["btn"])) {
    $login = htmlspecialchars($_POST["login"]);
    $pass = htmlspecialchars($_POST["pass"]);
    $errLogin = checkLenInput($login, $errLogin);
    $errPass = checkLenInput($pass, $errPass);
    if ($errLogin == "" && $errPass == "") {
      $errPass = openJson($login, $pass, $errPass);
    }
    if ($errPass == "") {
      header("Location: chat.php");
    }
  }

  $_SESSION["login"] = $login;
  $_SESSION["pass"] = $pass;

  function checkLenInput($value, $err) {
      if (strlen(trim($value)) < 3) {
        $err = "Your username or password cannot be shorter than 3 characters.";
      }
      return $err;
    }

  function openJson($login, $pass, $errPass) {
    $usersFile = "users.json";
    $jsonUsers = json_decode(file_get_contents($usersFile), true);
    $ifFindUser = false;
    $index = 0;
    foreach ($jsonUsers as $value){
      if ($value["login"] == $login){
        $userPass = $value["pass"];
        $ifFindUser = true;
      }
      $index++;
    }
    if (!$ifFindUser) {
      $jsonUsers[$index]["login"] = $login;
      $jsonUsers[$index]["pass"] = $pass;
      $newJsonString = json_encode($jsonUsers, JSON_PRETTY_PRINT);
      file_put_contents($usersFile, $newJsonString);
    } else {
      if ($pass != $userPass){
        $errPass = "Incorrect password";
      }
    }
    return $errPass;
  }
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>auth</title>
	</head>
	<link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet'>
	<link href='https://fonts.googleapis.com/css?family=Pacifico' rel='stylesheet'>
	<link rel='stylesheet' type='text/css' href='style/auth.css'>
	<body>
		<header>
			<div class="headerCnt color1"></div>
			<div class="headerCnt color2"></div>
			<div class="headerCnt color3"></div>
			<div class="headerCnt color4"></div>
			<div class="headerCnt color5"></div>
			<div class="headerCnt color1"></div>
			<div class="headerCnt color2"></div>
			<div class="headerCnt color3"></div>
			<div class="headerCnt color4"></div>
			<div class="headerCnt color5"></div>
		</header>
		<div class="title">Easy Chat</div>
		<form method="POST" action="">
			Enter your name:
			<span><?=$errLogin?></span>
			<input class="text" type="text" name="login" value="<?=$_SESSION["login"]?>">
			Enter your password:
			<span><?=$errPass?></span>
			<input class="text" type="password" name="pass" >
			<div class="shadowContainer">
				<input class="btn" id="authBtn" type="submit" name="btn" value="Go">
				<div class="shadow"></div>
			</div>
		</form>
	</body>
</html>
