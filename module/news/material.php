<?php 
$Param['id'] += 0;
if ($Param['id'] == 0) MessageSend(1, 'URL адрес указан неверно.', '/news');
$Row = mysqli_fetch_assoc(mysqli_query($CONNECT, 'SELECT `name`, `added`, `date`, `read`, `text` FROM `news` WHERE `id` = '.$Param['id']));
if (!$Row['name']) MessageSend(1, 'Такой новости не существует.', '/news');
mysqli_query($CONNECT, 'UPDATE `news` SET `read` = `read` + 1 WHERE `id` = '.$Param['id']);
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
if ($_SESSION['USER_GROUP'] == 2) $EDIT = '<a href="/news/edit/id/'.$Param['id'].'" class="lol">Редактировать новость</a>';
echo 'Просомтров: '.($Row['read'] + 1).' | Добавил: '.$Row['added'].' | Дата: '.$Row['date'].' | '.$EDIT.'<br><br><b>'.$Row['name'].'</b><br>'.$Row['text'] ?>
</div>
</div>

<?php Footer() ?>
</div>
</body>
</html>