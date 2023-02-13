<?php 
if ($Param['com_delete']) {
mysqli_query($CONNECT, "DELETE FROM `comments` WHERE `id` = $Param[com_delete]");	
MessageSend(3, 'Комментарий удален.');
} 


else if ($_POST['change_group']) {
mysqli_query($CONNECT, "UPDATE `users` SET `group` = $_POST[group] WHERE `login` = '$_POST[login]'");	
MessageSend(3, 'Группа пользователя <b>'.$_POST['login'].'</b> изменена.');
}


else if ($Param['logout'])  {
unset($_SESSION['ADMIN_LOGIN_IN']);
MessageSend(3, 'Сессия Администратора удалена.', '/');
}

else MessageSend(1, 'Обработка запроса не возможна.', '/admin');
?>