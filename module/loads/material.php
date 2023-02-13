<?php 
$Param['id'] += 0;
if ($Param['id'] == 0) MessageSend(1, 'URL адрес указан неверно.', '/loads');
$Row = mysqli_fetch_assoc(mysqli_query($CONNECT, 'SELECT `name`, `added`, `date`, `read`, `text`, `active`, `download`, `dimg`, `dfile`, `link` FROM `load` WHERE `id` = '.$Param['id']));
if (!$Row['name']) MessageSend(1, 'Такой новости не существует.', '/loads');
if (!$Row['active'] and $_SESSION['USER_GROUP'] != 2) MessageSend(1, 'Новость ожидает модерации.', '/loads');


if ($Row['link'] and !$Row['dfile']) $Download = $Row['link'];
else $Download = '/loads/download/id/'.$Param['id'];


mysqli_query($CONNECT, 'UPDATE `load` SET `read` = `read` + 1 WHERE `id` = '.$Param['id']);
Head($Row['name']);
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
if (!$Row['active']) $Active = '| <a href="/loads/control/id/'.$Param['id'].'/command/active" class="lol">Активировать новость</a>';
if ($_SESSION['USER_GROUP'] == 2) $EDIT = '| <a href="/loads/edit/id/'.$Param['id'].'" class="lol">Редактировать новость</a> | <a href="/loads/control/id/'.$Param['id'].'/command/delete" class="lol">Удалить новость</a>'.$Active;
echo '<a href="'.$Download.'" class="lol">Скачать</a> | Просомтров: '.($Row['read'] + 1).' | Скачивания: '.$Row['download'].' | Добавил: '.$Row['added'].' | Дата: '.$Row['date'].' '.$EDIT.'<br><br><b>'.$Row['name'].'</b><br><img src="/catalog/img/'.$Row['dimg'].'/'.$Param['id'].'.jpg" alt="'.$Row['name'].'"><br>'.$Row['text'];
COMMENTS()
?>
</div>
</div>

<?php Footer() ?>
</div>
</body>
</html>