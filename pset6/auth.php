<?php
$login    = '';
$pass     = '';
$errLogin = '';
$errPass  = '';
session_start();
$_SESSION['auth'] = false;
if (isset($_POST['btn'])) {
    $login    = htmlspecialchars($_POST['login']);
    $pass     = htmlspecialchars($_POST['pass']);
    $errLogin = checkLenInput($login, $errLogin);
    $errPass  = checkLenInput($pass, $errPass);
    if ($errLogin === '' && $errPass === '') {
        $errPass = openDB($login, $pass, $errPass);
    }
    if ($errPass === '') {
        $_SESSION['auth'] = true;
        header('Location: chat.php');
    }
}

$_SESSION['login'] = $login;
$_SESSION['pass']  = $pass;

function checkLenInput($value, $err) {
    if (strlen(trim($value)) < 3) {
        $err = 'Your username or password cannot be shorter than 3 characters.';
    }
    return $err;
}

function openDB($login, $pass, $errPass) {
    $host = 'localhost';
    $db = 'easy_chat_db';
    $un = 'root';
    $pw = '';

    $connection = new mysqli($host, $un, $pw, $db);
    if ($connection->connect_error) {
      die($connection->connect_error);
    }
    $query = "SELECT * FROM users WHERE login='$login'";
    $result = $connection->query($query);
    $numrows = $result->num_rows;

    if ($numrows == 0) {
      $query = "INSERT INTO users VALUES(NULL, '$login', '$pass')";
      $usersTable = $connection->query($query);
    } else {
      $result->data_seek(0);
      $userInfo = $result->fetch_array(MYSQLI_ASSOC);
      if ($userInfo['password'] != $pass) {
        $errPass = 'Incorrect password';
      }
    }

    $result->close();
    $connection->close();

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
