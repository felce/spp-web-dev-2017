<?php
function logging($log) {
  $fp = fopen('log.txt', 'a');
  $time = date('H:i:s');
  $_SESSION['last_log_text'] = '';

  $_SESSION['log_time'] = $time;
  $_SESSION['log_text'] = $log;
  fwrite($fp, $time);
  fwrite($fp, $log. PHP_EOL);
  fclose($fp);
}
