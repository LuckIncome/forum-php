<?php 
$Param['id'] += 0;
if ($Param['id'] == 0) MessageSend(1, 'URL адрес указан неверно.', '/news');
$Row = mysqli_fetch_assoc(mysqli_query($CONNECT, 'SELECT `name`, `added`, `date`, `text`, `active`, `rate`, `rateusers` FROM `news` WHERE `id` = '.$Param['id']));
if (!$Row['name']) MessageSend(1, 'Такой новости не существует.', '/news');
if (!$Row['active'] and $_SESSION['USER_GROUP'] != 2) MessageSend(1, 'Новость ожидает модерации.', '/news');
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

if ($Row['rateusers']) {
$Exp = explode(',', $Row['rateusers']);

foreach ($Exp as $value) {
if ($value) {
$Row2 = mysqli_fetch_assoc(mysqli_query($CONNECT, "SELECT `login` FROM `users` WHERE `id` = $value"));
$RATED .= '<a href="/user/'.$Row2['login'].'" class="lol">'.$Row2['login'].'</a> ';
}
}

} else $RATED = 'n/a';



if (!$Row['active']) $Active = '| <a href="/news/control/id/'.$Param['id'].'/command/active" class="lol">Активировать новость</a>';
if ($_SESSION['USER_GROUP'] == 2) $EDIT = '| <a href="/news/edit/id/'.$Param['id'].'" class="lol">Редактировать новость</a> | <a href="/news/control/id/'.$Param['id'].'/command/delete" class="lol">Удалить новость</a>'.$Active;
echo 'Добавил: '.$Row['added'].' | Оценок: '.$Row['rate'].' | Дата: '.$Row['date'].' '.$EDIT.'<br>Оценили: '.$RATED.'<br><br><a href="/rate/news/id/'.$Param['id'].'" class="button">Мне нравится</a><br><br><b>'.$Row['name'].'</b><br>'.$Row['text'];
COMMENTS()
?>
</div>
</div>

<?php Footer() ?>
</div>
</body>
</html>