<?php
Uaccess(2);


if ($Param['action'] == 'delete') {
mysqli_query($CONNECT, "DELETE FROM `comments` WHERE `id` = $Param[id]");
MessageSend(3, 'Комментарий удален.');

} else if ($Param['action'] == 'edit') {
$_SESSION['COMMENTS_EDIT'] = $Param['id'];
exit(header('location: '.$_SERVER['HTTP_REFERER']));


} else if ($_POST['save']) {
mysqli_query($CONNECT, "UPDATE `comments` SET `text` = '$_POST[text]' WHERE `id` = $_SESSION[COMMENTS_EDIT]");
unset($_SESSION['COMMENTS_EDIT']);
MessageSend(3, 'Коментарий отредактирован.');	
	
	
} else if ($_POST['cancel']) {
unset($_SESSION['COMMENTS_EDIT']);
MessageSend(3, 'Редактирование отмененно.');
}


?>