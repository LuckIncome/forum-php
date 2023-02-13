<?php 
ULogin(1);

if ($_POST['enter'] and $_POST['text']) {
$_POST['text'] = FormChars($_POST['text']);
$ID = ModuleID($Param['module']);
if ($ID == 1) $Table = 'news';
else if ($ID == 2) $Table = 'loads';
$Row = mysqli_fetch_assoc(mysqli_query($CONNECT, 'SELECT `id` FROM `'.$Table.'` WHERE `id` = '.$Param['id']));
if (!$Row['id']) MessageSend(1, 'Материал не найден.', '/'.$Param['module']);
mysqli_query($CONNECT, "INSERT INTO `comments`  VALUES ('', $Param[id], $ID, '$_SESSION[USER_LOGIN]', '$_POST[text]', NOW())");
MessageSend(3, 'Комментарий добавлен.', '/'.$Param['module'].'/material/id/'.$Param['id']);
}
?>