<?php 
ULogin(1);

$Param['id'] += 0;


$Info = mysqli_fetch_assoc(mysqli_query($CONNECT, "SELECT `recive`, `send` FROM `dialog` WHERE `id` = $Param[id]"));
if (!in_array($_SESSION['USER_ID'], $Info)) MessageSend(1, 'Диалог не найден.', '/');


if ($Info['recive'] == $_SESSION['USER_ID']) mysqli_query($CONNECT, "UPDATE `dialog` SET `status` = 1 WHERE `id` = $Param[id]");

if ($Info['send'] == $_SESSION['USER_ID']) $Info['send'] = $Info['recive'];
	
$User = mysqli_fetch_assoc(mysqli_query($CONNECT, "SELECT `login` FROM `users` WHERE `id` = $Info[send]"));

Head('Диалог с '.$User['login']);
?>
<body>
<div class="wrapper">
<div class="header"></div>
<div class="content">
<?php Menu();
MessageShow() 
?>
<div class="Page">
<?php
$Query = mysqli_query($CONNECT, "SELECT * FROM `message` WHERE `did` = $Param[id] ORDER BY `id` DESC");

while ($Row = mysqli_fetch_assoc($Query)) {

if ($Row['user'] == $_SESSION['USER_ID']) $delete = ' | <a href="/pm/control/delete/message/id/'.$Row['id'].'" class="lol">Удалить</a>';
else $delete = '';


if ($Info['send'] == $Row['user']) $Row['user'] = $User['login'];
else $Row['user'] = $_SESSION['USER_LOGIN'];

echo '<div class="ChatBlock"><span>'.$Row['date'].' от '.$Row['user'].$delete.'</span>'.$Row['text'].'</div>';
}
?>
<form method="POST" action="/pm/send">
<input type="hidden" name="login" value="<?php echo $User['login'] ?>">
<br><textarea class="ChatMessage" name="text" placeholder="Текст сообщения" required></textarea>
<br><input type="submit" name="enter" value="Отправить"> <input type="reset" value="Очистить">
</form>
</div>
</div>

<?php Footer() ?>
</div>
</body>
</html>