<?php
UAccess(2);

if ($Param['id'] and $Param['command']) {

if ($Param['command'] == 'delete') {
$Row = mysqli_fetch_assoc(mysqli_query($CONNECT, "SELECT `dfile`, `dimg` FROM `loads` WHERE `id` = $Param[id]"));
mysqli_query($CONNECT, "DELETE FROM `loads` WHERE `id` = $Param[id]");
mysqli_query($CONNECT, "DELETE FROM `comments` WHERE `material` = $Param[id] AND `module` = 2");
unlink('catalog/img/'.$Row['dimg'].'/'.$Param['id'].'.jpg');
unlink('catalog/mini/'.$Row['dimg'].'/'.$Param['id'].'.jpg');
if ($Row['dfile']) unlink('catalog/file/'.$Row['dfile'].'/'.$Param['id'].'.zip');
MessageSend(3, 'Материал удален.', '/loads');
} else if ($Param['command'] == 'active') {
mysqli_query($CONNECT, "UPDATE `loads` SET `active` = 1 WHERE `id` = $Param[id]");
MessageSend(3, 'Материал активирован.', '/loads/material/id/'.$Param['id']);
}


}
?>