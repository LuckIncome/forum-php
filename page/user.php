<?php 
if ($Module) {
$Module = FormChars($Module);
$Info = mysqli_fetch_assoc(mysqli_query($CONNECT, "SELECT `id`, `name`, `email`, `country`, `regdate`, `avatar` FROM `users` WHERE `login` = '$Module'"));
if (!$Info['id']) MessageSend(1, 'Пользователь не найден.', '/user');


if (!$Info['avatar']) $Avatar = 0;
else $Avatar = "$Info[avatar]/$Info[id]";

$Draw = '
<img src="/resource/avatar/'.$Avatar.'.jpg" width="120" height="120" alt="Аватар" align="left">
<div class="Block">
ID '.$Info['id'].' ('.UserGroup($Info['group']).')
<br>Имя '.$Info['name'].'
<br>E-mail '.HideEmail($Info['email']).'
<br>Страна '.UserCountry($Info['country']).'
<br>Дата регистрации '.$Info['regdate'].'
</div>
<a href="/" class="button ProfileB">Написать</a><br><br>
<div class="ProfileEdit">
</div>';
} else {
$Query = mysqli_query($CONNECT, 'SELECT `login`, `name` FROM `users` ORDER BY `id` DESC LIMIT 10');
while ($Row = mysqli_fetch_assoc($Query)) $Draw .= "<br>Логин: $Row[login] ( имя: $Row[name] )";
}


ULogin(1);
Head('Профиль пользователя') ?>
<body>
<div class="wrapper">
<div class="header"></div>
<div class="content">
<?php Menu();
MessageShow() 
?>
<div class="Page">
<?php echo $Draw ?>
</div>
</div>

<?php Footer() ?>
</div>
</body>
</html>