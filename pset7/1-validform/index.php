<?php
    session_start();
    $_SESSION['errIp'] = '';
    $_SESSION['errURL'] = '';
    $_SESSION['errEmail'] = '';
    $_SESSION['errDate'] = '';
    $_SESSION['errTime'] = '';

    $_SESSION['ip'] = '';
    $_SESSION['URL'] = '';
    $_SESSION['email'] = '';
    $_SESSION['date'] = '';
    $_SESSION['time'] = '';

    if (isset($_POST['btn'])) {
      $_SESSION['ip'] = $ip = htmlspecialchars($_POST['ip']);
      $_SESSION['URL'] = $url = htmlspecialchars($_POST['url']);
      $_SESSION['email'] = $email = htmlspecialchars($_POST['email']);
      $_SESSION['date'] = $date = htmlspecialchars($_POST['date']);
      $_SESSION['time'] = $time = htmlspecialchars($_POST['time']);

      $patternIp = '~^((25[0-5]|2[0-4]\d|[01]?\d?\d)\.){3}(25[0-5]|2[0-4]\d|[01]?\d?\d)$~';

      $patternUrl = '~^https?:\/\/[^ /$.?#].[^ ]*$~i';

      $patternEmail = '~^[A-Za-z\d]{1}([._-]?[A-Za-z\d]){1,60}@[A-Za-z\d]{2,250}(\.[a-z]{2,6})?$~';

      $patternDate = '~^((([0][1-9])|([1]\d)|(2[0-8]))\/[0][2])|((([0][1-9])|([12]\d)|([3][0])|([3][1]))\/(([0][13578])|([1][0])|([1][2])))|((([0][1-9])|([12]\d)|([3][0]))\/(([0][469])|([1][1])))\/\d{4}$~';

      $patternTime = '~^([01]\d|[2][0-3])\:([0-5]\d)\:([0-5]\d)$~';

      $inputs = [$ip, $url, $email, $date, $time];
      $patterns = [$patternIp, $patternUrl, $patternEmail, $patternDate, $patternTime];
      $errors = ['errIp', 'errURL', 'errEmail', 'errDate', 'errTime'];

      for ($i = 0; $i < 5; $i++) {
        if (preg_match($patterns[$i], $inputs[$i])) {
          $_SESSION[$errors[$i]] = 'ok';
        } else {
          $_SESSION[$errors[$i]]  = 'incorrect';
        }
      }
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>valid-php</title>
        <style>
            input, button {
              width: 300px;
              margin: 10px auto;
              display: block;
            }
        </style>
    </head>
    <body align="center">
        <form method="POST">
            <span id="errIp"><?php echo $_SESSION['errIp']; ?></span>
            <input type="text" name="ip" placeholder="ip" value="<?=$_SESSION['ip']?>">
            <span id="errURL"><?php echo $_SESSION['errURL']; ?></span>
            <input type="text" name="url" placeholder="url" value="<?=$_SESSION['URL']?>">
            <span id="errEmail"><?php echo $_SESSION['errEmail']; ?></span>
            <input type="text" name="email" placeholder="email" value="<?=$_SESSION['email']?>">
            <span id="errDate"><?php echo $_SESSION['errDate']; ?></span>
            <input type="text" name="date" placeholder="date MM/DD/YYYY" value="<?=$_SESSION['date']?>">
            <span id="errTime"><?php echo $_SESSION['errTime']; ?></span>
            <input type="text" name="time" placeholder="time HH:MM:SS" value="<?=$_SESSION['time']?>">
            <input type="submit" name="btn" value="check">
        </form>
    </body>
</html>
