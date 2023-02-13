<?php
if (!$Param['id']) MessageSend(1, 'Файл не указан', '/loads');
$Param['id'] += 0;
$Row = mysqli_fetch_assoc(mysqli_query($CONNECT, "SELECT `dfile`, `link` FROM `load` WHERE `id` = $Param[id]"));
if (!$Row['dfile'] and !$Row['link']) MessageSend(1, 'Файл не найден', '/loads');
mysqli_query($CONNECT, "UPDATE `load` SET `download` = `download` + 1 WHERE `id` = $Param[id]");
if ($Row['dfile']) header('location: /catalog/file/'.$Row['dfile'].'/'.$Param['id'].'.zip');
else header('location: '.$Row['link']);
?>