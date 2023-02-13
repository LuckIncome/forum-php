<?php 
if ($Module == 'register' and $_POST['enter']) {
$_POST['login'] = FormChars($_POST['login']);
$_POST['email'] = FormChars($_POST['email']);
$_POST['password'] = GenPass(FormChars($_POST['password']), $_POST['login']);
$_POST['name'] = FormChars($_POST['name']);
$_POST['country'] = FormChars($_POST['country']);
$_POST['avatar'] = FormChars($_POST['avatar']);
$_POST['avatar'] = 0;
if (!$_POST['login'] or !$_POST['email'] or !$_POST['password'] or !$_POST['name'] or $_POST['country'] > 4) exit('Ошибка валидации формы.');

$Row = mysqli_fetch_assoc(mysqli_query($CONNECT, "SELECT `login` FROM `users` WHERE `login` = '$_POST[login]'"));
if ($Row['login']) exit('Логин <b>'.$_POST['login'].'</b> уже используеться.');
$Row = mysqli_fetch_assoc(mysqli_query($CONNECT, "SELECT `email` FROM `users` WHERE `email` = '$_POST[email]'"));
if ($Row['login']) exit('E-Mail <b>'.$_POST['email'].'</b> уже используеться.');
mysqli_query($CONNECT, "INSERT INTO `users`  VALUES ('', '$_POST[login]', '$_POST[password]', '$_POST[name]', NOW(), '$_POST[email]', $_POST[country], $_POST[avatar])");


echo 'OK';
}
?>