<?php
if (!$Param['id']) MessageSend(1, 'Файл не указан', '/loads');
$Param['id'] += 0;
$Row = mysqli_fetch_assoc(mysqli_query($CONNECT, "SELECT `dfile` FROM `load` WHERE `id` = $Param[id]"));
if (!$Row['dfile']) MessageSend(1, 'Файл не найден', '/loads');
mysqli_query($CONNECT, "UPDATE `load` SET `download` = `download` + 1 WHERE `id` = $Param[id]");
header('location: /catalog/file/'.$Row['dfile'].'/'.$Param['id'].'.zip');
?>