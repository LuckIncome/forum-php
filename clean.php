<?php
// Это скрипт для CRON задачи (Очистка старых сообщений в чате).
include_once 'setting.php';
$CONNECT = mysqli_connect(HOST, USER, PASS, DB);
mysqli_query($CONNECT, "DELETE FROM `chat` WHERE `time` < SUBTIME(NOW(), '3 0:0:0')");
?>