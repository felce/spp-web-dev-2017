<?php
    session_start();
    if (!$_SESSION['auth']){
      header('Location: auth.php');
    }
    ?>
<!DOCTYPE html>
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
            <div class="header_cnt color_grape"></div>
            <div class="header_cnt color_clay_creek"></div>
            <div class="header_cnt color_flax"></div>
            <div class="header_cnt color_cream"></div>
            <div class="header_cnt color_neptune"></div>
            <div class="header_cnt color_grape"></div>
            <div class="header_cnt color_clay_creek"></div>
            <div class="header_cnt color_flax"></div>
            <div class="header_cnt color_cream"></div>
            <div class="header_cnt color_neptune"></div>
        </header>
        <div id="welcomemessage" class="welcome"></div>
        <div class="title">Easy Chat</div>
        <div class="chat" id="chatcnt" >
            <div id="messages" class="messages_cnt" >
            </div>
        </div>
        <form id="formMessage">
            <input class="text" type="text" placeholder="enter your message..." name="newMessage">
            <input class="btn" type="submit" name="send" value="Send">
        </form>
        <script src='js/chat.js'></script>
    </body>
</html>
