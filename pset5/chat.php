<?php
  $errMessage = "";
  session_start();
  if ($_SESSION["login"] == ""){
    header("Location: auth.php");
  }
 ?>

 <html lang="en">
 	<head>
 		<meta charset="utf-8">
 		<title>Easy chat</title>
 		<link href='https://fonts.googleapis.com/css?family=Pacifico' rel='stylesheet'>
 		<link rel='stylesheet' type='text/css' href='style/chat.css'>
 		<script src='js/jquery-3.2.1.min.js'></script>
 	</head>
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
    <div class="chat" id="chatcnt" >
   		<div id="messages" class="messagesCnt" >
      </div>
    </div>
 		<form id="formMessage">
 			<input class="text" type="text" placeholder="enter your message..." name="newMessage">
 			<input class="btn" type="submit" name="send" value="Send">
 		</form>

    <script src='js/chat.js'></script>
</body>
</html>
