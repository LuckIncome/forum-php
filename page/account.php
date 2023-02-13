<?php
if ($Module == 'logout' and $_SESSION['USER_LOGIN_IN']) {
if ($_COOKIE['user']) {
setcookie('user', '', strtotime('-30 days'), '/');
unset($_COOKIE['user']);
}
session_unset();
Location('/login');
}




function CheckRegInfo($p1, $p2) {
global $CONNECT;
if (mysqli_fetch_assoc(mysqli_query($CONNECT, "SELECT `login` FROM `users` WHERE `login` = '$p1'"))) MessageSend(1, 'Логин <b>'.$_POST['login'].'</b> уже используеться.');
else if (mysqli_fetch_assoc(mysqli_query($CONNECT, "SELECT `email` FROM `users` WHERE `email` = '$p2'"))) MessageSend(1, 'E-Mail <b>'.$_POST['email'].'</b> уже используеться.');
}




function MIX($p1) {
return md5($p1.date('d.m.Y H').'65475g45');
}




function check_login($p1) {
if (!preg_match('/^[A-z0-9]{3,10}$/', $p1)) MessageSend(1, 'Логин может содержать только латинские буквы и цифры, длиной от 3 до 10 символов');
}



function check_password($p1) {
if (!preg_match('/^[A-z0-9]{5,15}$/', $p1)) MessageSend(1, 'Пароль может содержать только латинские буквы и цифры, длиной от 3 до 10 символов');
}


function check_captcha($p1) {
if (!preg_match('/^[0-9]{1,5}$/', $p1)) MessageSend(1, 'Капча может содержать только цифры, длиной от 1 до 5 символов');
}


function check_email($p1) {
if (!preg_match('/^([A-z0-9_\.-]+)@([A-z0-9_\.-]+)\.([A-z\.]{2,6})$/', $p1)) MessageSend(1, 'E-mail указан не верно');
}



function check_name($p1) {
if (!preg_match('/^[А-я]{3,10}$/u', $p1)) MessageSend(1, 'Имя может содержать только русские буквы, длиной от 3 до 10 символов');
}


function check_country($p1) {
if (!preg_match('/^[0-4]{1,1}$/', $p1)) MessageSend(1, 'Страна указана не верно');
}


if ($Module == 'edit' and $_POST['enter']) {
ULogin(1);
$_POST['opassword'] = FormChars($_POST['opassword']);
$_POST['npassword'] = FormChars($_POST['npassword']);
$_POST['name'] = FormChars($_POST['name']);
$_POST['country'] = FormChars($_POST['country']);

if ($_POST['opassword'] or $_POST['npassword']) {
if (!$_POST['opassword']) MessageSend(2, 'Не указан старый пароль');
if (!$_POST['npassword']) MessageSend(2, 'Не указан новый пароль');
if ($_SESSION['USER_PASSWORD'] != GenPass($_POST['opassword'], $_SESSION['USER_LOGIN'])) MessageSend(2, 'Старый пароль указан не верно.');
$Password = GenPass($_POST['npassword'], $_SESSION['USER_LOGIN']);
mysqli_query($CONNECT, "UPDATE `users`  SET `password` = '$Password' WHERE `id` = $_SESSION[USER_ID]");
$_SESSION['USER_PASSWORD'] = $Password;
}


if ($_POST['name'] != $_SESSION['USER_NAME']) {
mysqli_query($CONNECT, "UPDATE `users`  SET `name` = '$_POST[name]' WHERE `id` = $_SESSION[USER_ID]");
$_SESSION['USER_NAME'] = $_POST['name'];
}


if (UserCountry($_POST['country']) != $_SESSION['USER_COUNTRY']) {
mysqli_query($CONNECT, "UPDATE `users`  SET `country` = $_POST[country] WHERE `id` = $_SESSION[USER_ID]");
$_SESSION['USER_COUNTRY'] = UserCountry($_POST['country']);
}


if ($_FILES['avatar']['tmp_name']) {
if ($_FILES['avatar']['type'] != 'image/jpeg') MessageSend(2, 'Не верный тип изображения.');
if ($_FILES['avatar']['size'] > 20000) MessageSend(2, 'Размер изображения слишком большой.');
$Image = imagecreatefromjpeg($_FILES['avatar']['tmp_name']);
$Size = getimagesize($_FILES['avatar']['tmp_name']);
$Tmp = imagecreatetruecolor(120, 120);
imagecopyresampled($Tmp, $Image, 0, 0, 0, 0, 120, 120, $Size[0], $Size[1]);
if ($_SESSION['USER_AVATAR'] == 0) {
$Files = glob('resource/avatar/*', GLOB_ONLYDIR);
foreach($Files as $num => $Dir) {
$Num ++;
$Count = sizeof(glob($Dir.'/*.*'));
if ($Count < 250) {
$Download = $Dir.'/'.$_SESSION['USER_ID'];
$_SESSION['USER_AVATAR'] = $Num;
mysqli_query($CONNECT, "UPDATE `users`  SET `avatar` = $Num WHERE `id` = $_SESSION[USER_ID]");
break;
}
}
}
else $Download = 'resource/avatar/'.$_SESSION['USER_AVATAR'].'/'.$_SESSION['USER_ID'];
imagejpeg($Tmp, $Download.'.jpg');
imagedestroy($Image);
imagedestroy($Tmp);
}




MessageSend(3, 'Данные изменены.');
}









ULogin(0);



if ($Module == 'restore' and $Param['code'] and $_SESSION['RESTORE_INFO'] and $_SESSION['RESTORE_CONFIRM']) {
if (MIX($_SESSION['RESTORE_CONFIRM']) != $Param['code']) MessageSend(1, 'Восстановление не возможно.');
$Random = RandomString(15);
$Password = GenPass($Random, $_SESSION['RESTORE_INFO']);
mysqli_query($CONNECT, "UPDATE `users` SET `password` = '$Password' WHERE `login` = '$_SESSION[RESTORE_INFO]'");
unset($_SESSION['RESTORE_INFO']);
unset($_SESSION['RESTORE_CONFIRM']);
MessageSend(2, 'Пароль успешно изменен, для входа используйте новый пароль <b>'.$Random.'</b>', '/login');
}




if ($Module == 'restore' and $_POST['enter']) {
$_POST['login'] = FormChars($_POST['login'], 1);
$_POST['captcha'] = FormChars($_POST['captcha']);
if (!$_POST['login'] or !$_POST['captcha']) MessageSend(1, 'Невозможно обработать форму.');
if ($_SESSION['captcha'] != md5($_POST['captcha'])) MessageSend(1, 'Капча введена не верно.');
$Row = mysqli_fetch_assoc(mysqli_query($CONNECT, "SELECT `id`, `email`, `login` FROM `users` WHERE `login` = '$_POST[login]'"));
if (!$Row['email']) MessageSend(1, 'Пользователь не найден.');
$_SESSION['RESTORE_INFO'] = $Row['login'];
$_SESSION['RESTORE_CONFIRM'] = GenPass($_POST['email'], $_POST['id']);
mail($Row['email'], 'Восстановление пароля', 'Ссылка для восстановления: http://php.webtm.ru/account/restore/code/'.MIX($_SESSION['RESTORE_CONFIRM']), 'From: robot@php.webtm.ru');
MessageSend(2, 'На ваш E-mail адрес <b>'.HideEmail($Row['email']).'</b> отправлено подтерждение смены пароля');
}





if ($Module == 'register' and $_POST['enter']) {

check_captcha($_POST['captcha']);
if ($_SESSION['captcha'] != md5($_POST['captcha'])) MessageSend(1, 'Капча введена не верно');

check_login($_POST['login']);
check_password($_POST['password']);
check_email($_POST['email']);
check_name($_POST['name']);
check_country($_POST['country']);

CheckRegInfo($_POST['login'], $_POST['email']);
$_SESSION['REGISTER_INFO'] = "$_POST[login],$_POST[password],$_POST[name],$_POST[email],$_POST[country]";
$_SESSION['REGISTER_CONFIRM'] = GenPass($_POST['email'], $_POST['login']);
mail($_POST['email'], 'Регистрация', 'Ссылка для активации: http://php.webtm.ru/account/activate/code/'.MIX($_SESSION['REGISTER_CONFIRM']), 'From: robot@php.webtm.ru');
MessageSend(3, 'Регистрация акаунта успешно завершена. На указанный E-mail адрес <b>'.$_POST['email'].'</b> отправленно письмо о подтверждении регистрации.');
}




else if ($Module == 'activate' and $Param['code'] and $_SESSION['REGISTER_INFO'] and $_SESSION['REGISTER_CONFIRM']) {
if (MIX($_SESSION['REGISTER_CONFIRM']) != $Param['code']) MessageSend(1, 'Активация не возможна.');
CheckRegInfo($Exp[0], $Exp[3]);
$Exp = explode(',', $_SESSION['REGISTER_INFO']);
mysqli_query($CONNECT, "INSERT INTO `users`  VALUES ('', '$Exp[0]', '$Exp[1]', '$Exp[2]', NOW(), '$Exp[3]', $Exp[4], 0, 0, 0)");
unset($_SESSION['REGISTER_INFO']);
unset($_SESSION['REGISTER_CONFIRM']);
MessageSend(3, 'Аккаунт подтвержден.', '/login');
}



else if ($Module == 'login' and $_POST['enter']) {

check_captcha($_POST['captcha']);
if ($_SESSION['captcha'] != md5($_POST['captcha'])) MessageSend(1, 'Капча введена не верно');

check_login($_POST['login']);
check_password($_POST['password']);

$_POST['password'] = GenPass($_POST['password'], $_POST['login']);


$Row = mysqli_fetch_assoc(mysqli_query($CONNECT, "SELECT `password` FROM `users` WHERE `login` = '$_POST[login]'"));
if ($Row['password'] != $_POST['password']) MessageSend(1, 'Не верный логин или пароль.');
$Row = mysqli_fetch_assoc(mysqli_query($CONNECT, "SELECT `id`, `name`, `regdate`, `email`, `country`, `avatar`, `password`, `login`, `group` FROM `users` WHERE `login` = '$_POST[login]'"));
$_SESSION['USER_LOGIN_IN'] = 1;
foreach ($Row as $Key => $Value) $_SESSION['USER_'.strtoupper($Key)] = $Value;
if ($_REQUEST['remember']) setcookie('user', $_POST['password'], strtotime('+30 days'), '/');
Location('/profile');
}
?>