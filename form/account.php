<?php 
if ($Module == 'register' and $_POST['enter']) {
$_POST['login'] = FormChars($_POST['login']);
$_POST['email'] = FormChars($_POST['email']);
$_POST['password'] = GenPass(FormChars($_POST['password']), $_POST['login']);
$_POST['name'] = FormChars($_POST['name']);
$_POST['country'] = FormChars($_POST['country']);
$_POST['captcha'] = FormChars($_POST['captcha']);
if (!$_POST['login'] or !$_POST['email'] or !$_POST['password'] or !$_POST['name'] or $_POST['country'] > 4 or !$_POST['captcha']) MessageSend(1, 'Невозможно обработать форму.');
if ($_SESSION['captcha'] != md5($_POST['captcha'])) MessageSend(1, 'Капча введена не верно.');
$Row = mysqli_fetch_assoc(mysqli_query($CONNECT, "SELECT `login` FROM `users` WHERE `login` = '$_POST[login]'"));
if ($Row['login']) exit('Логин <b>'.$_POST['login'].'</b> уже используеться.');
$Row = mysqli_fetch_assoc(mysqli_query($CONNECT, "SELECT `email` FROM `users` WHERE `email` = '$_POST[email]'"));
if ($Row['email']) exit('E-Mail <b>'.$_POST['email'].'</b> уже используеться.');
mysqli_query($CONNECT, "INSERT INTO `users`  VALUES ('', '$_POST[login]', '$_POST[password]', '$_POST[name]', NOW(), '$_POST[email]', $_POST[country], 0, 0)");
$Code = substr(base64_encode($_POST['email']), 0, -1);
mail($_POST['email'], 'Регистрация на блоге Mr.Shift', 'Ссылка для активации: http://mr-shift.ru/account/activate/code/'.substr($Code, -5).substr($Code, 0, -5), 'From: web@mr-shift.ru');
MessageSend(3, 'Регистрация акаунта успешно завершена. На указанный E-mail адрес <b>'.$_POST['email'].'</b> отправленно письмо о подтверждении регистрации.');
}


else if ($Module == 'activate' and $Param['code']) {
if (!$_SESSION['USER_ACTIVE_EMAIL']) {
$Email = base64_decode(substr($Param['code'], 5).substr($Param['code'], 0, 5));
if (strpos($Email, '@') !== false) {
mysqli_query($CONNECT, "UPDATE `users`  SET `active` = 1 WHERE `email` = '$Email'");
$_SESSION['USER_ACTIVE_EMAIL'] = $Email;
MessageSend(3, 'E-mail <b>'.$Email.'</b> подтвержден.', '/login');
}
else MessageSend(1, 'E-mail адрес не подтвержден.', '/login');
}
else MessageSend(1, 'E-mail адрес <b>'.$_SESSION['USER_ACTIVE_EMAIL'].'</b> уже подтвержден.', '/login');
}
?>