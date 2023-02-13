<?php
$Param['id'] += 0;
if (!$Param['id']) MessageSend(1, 'Файл не указан', '/loads');
$Row = mysqli_fetch_assoc(mysqli_query($CONNECT, "SELECT `dfile`, `link` FROM `loads` WHERE `id` = $Param[id]"));
if (!$Row['dfile'] and !$Row['link']) MessageSend(1, 'Файл не найден', '/loads');
if ($Row['dfile']) Location("/catalog/file/$Row[dfile]/$Param[id].zip");
else Location($Row['link']);
?>