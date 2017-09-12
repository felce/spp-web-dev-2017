<?php
session_start();
if ( $_SESSION['last_log_text'] != $_SESSION['log_text']){
  $_SESSION['last_log_text'] = $_SESSION['log_text'];
  echo $_SESSION['log_time'], $_SESSION['log_text'];
} else {
  echo '';
}
