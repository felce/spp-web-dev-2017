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
 		<?php echo "<link href='https://fonts.googleapis.com/css?family=Pacifico' rel='stylesheet'>"?>
 		<?php echo "<link rel='stylesheet' type='text/css' href='style/chat.css'>"?>
 		<?php echo "<script src='jquery-3.2.1.min.js'></script>"?>
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
 		<div id="messages" class="messagesCnt" ></div>
 		<form id="formMessage">
 			<input id="text" class="text" type="text" placeholder="enter your message..." name="newMessage">
 			<input class="btn" type="submit" name="send" value="Send">
 		</form>

<script>
  function show(){
    if ($("#messages:hover").length == 0) {
      $("#messages").scrollTop($("#messages")[0].scrollHeight - $("#messages")[0].clientHeight);
    }
    $.ajax({
      url: "find.php",
      cache: false,
      success: function(html) {
        $("#messages").html(html);
      }
    });
  }
  setInterval("show()", 100);

  $("#formMessage").submit(function(){
    var str = $(this).serialize();
    $("#text").value = "";
      $.ajax({
        type: "POST",
        url: "addMessage.php",
        data: str,
        success: function() {
            $("#formMessage")[0].reset();
        }
      });
      return false;
  });
</script>
</body>
</html>
