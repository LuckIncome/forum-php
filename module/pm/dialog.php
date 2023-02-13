<?php 
ULogin(1);

$Count = mysqli_fetch_row(mysqli_query($CONNECT, "SELECT COUNT(`id`) FROM `dialog` WHERE `send` = $_SESSION[USER_ID] OR `recive` = $_SESSION[USER_ID]"));
if (!$Count[0]) MessageSend(2, 'У вас нет диалогов', '/pm/send');

Head('Мои диалоги') ?>
<body>
<div class="wrapper">
<div class="header"></div>
<div class="content">
<?php Menu();
MessageShow() 
?>
<div class="Page">

<?php 

if (!$Param['page']) {
$Param['page'] = 1;
$Result = mysqli_query($CONNECT, "SELECT * FROM `dialog` WHERE `send` = $_SESSION[USER_ID] OR `recive` = $_SESSION[USER_ID] ORDER BY `id` DESC LIMIT 0, 5");
} else {
$Start = ($Param['page'] - 1) * 5;
$Result = mysqli_query($CONNECT, str_replace('START', $Start, "SELECT * FROM `dialog` WHERE `send` = $_SESSION[USER_ID] OR `recive` = $_SESSION[USER_ID] ORDER BY `id` DESC LIMIT START, 5"));
}


PageSelector('/pm/dialog/page/', $Param['page'], $Count);

while ($Row = mysqli_fetch_assoc($Result)) {
if ($Row['status']) $Status = 'Прочитано';
else $Status = 'Не прочитано';


if ($Row['send'] == $_SESSION['USER_ID']) $delete = ' | <a href="/pm/control/delete/dialog/id/'.$Row['id'].'" class="lol">Удалить</a>';
else $delete = '';



if ($Row['recive'] == $_SESSION['USER_ID']) $Row['recive'] = $Row['send'];
$User = mysqli_fetch_assoc(mysqli_query($CONNECT, "SELECT `login` FROM `users` WHERE `id` = $Row[recive]"));
echo '<div class="ChatBlock"><span>'.$Status.$delete.'</span><a href="/pm/message/id/'.$Row['id'].'" class="lol">Диалог с '.$User['login'].'</a></div>';
}


?>

</div>
</div>

<?php Footer() ?>
</div>
</body>
</html>