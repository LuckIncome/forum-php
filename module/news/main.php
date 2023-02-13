<?php 
if ($Module == 'category' and $Param['id'] != 1 and $Param['id'] != 2 and $Param['id'] != 3) MessageSend(1, 'Такой категории не существует.', '/news');
$Param['page'] += 0;
Head('Новости');
?>
<body>
<div class="wrapper">
<div class="header"></div>
<div class="content">
<?php Menu();
MessageShow() 
?>
<div class="CatHead">
<?php if ($_SESSION['USER_LOGIN_IN']) echo '<a href="/news/add"><div class="Cat">Добавить новость</div></a>' ?>
<a href="/news"><div class="Cat">Все категории</div></a>
<a href="/news/category/id/1"><div class="Cat">Категория 1</div></a>
<a href="/news/category/id/2"><div class="Cat">Категория 2</div></a>
<a href="/news/category/id/3"><div class="Cat">Категория 3</div></a>
<?php SearchForm() ?>
</div>

<div class="Page">
<?php 
if (!$Module or $Module == 'main') {
if ($_SESSION['USER_GROUP'] != 2) $Active = 'WHERE `active` = 1';
$Param1 = 'SELECT `id`, `name`, `added`, `date`, `active` FROM `news` '.$Active.' ORDER BY `id` DESC LIMIT 0, 5';
$Param2 = 'SELECT `id`, `name`, `added`, `date`, `active` FROM `news` '.$Active.' ORDER BY `id` DESC LIMIT START, 5';
$Param3 = 'SELECT COUNT(`id`) FROM `news`';
$Param4 = '/news/main/page/';
} else if ($Module == 'category') {
if ($_SESSION['USER_GROUP'] != 2) $Active = 'AND `active` = 1';
$Param1 = 'SELECT `id`, `name`, `added`, `date`, `active` FROM `news` WHERE `cat` = '.$Param['id'].' '.$Active.' ORDER BY `id` DESC LIMIT 0, 5';
$Param2 = 'SELECT `id`, `name`, `added`, `date`, `active` FROM `news` WHERE `cat` = '.$Param['id'].' '.$Active.' ORDER BY `id` DESC LIMIT START, 5';
$Param3 = 'SELECT COUNT(`id`) FROM `news` WHERE `cat` = '.$Param['id'];
$Param4 = '/news/category/id/'.$Param['id'].'/page/';
}

$Count = mysqli_fetch_row(mysqli_query($CONNECT, $Param3));

if (!$Param['page']) {
$Param['page'] = 1;
$Result = mysqli_query($CONNECT, $Param1);
} else {
$Start = ($Param['page'] - 1) * 5;
$Result = mysqli_query($CONNECT, str_replace('START', $Start, $Param2));
}


PageSelector($Param4, $Param['page'], $Count);

while ($Row = mysqli_fetch_assoc($Result)) {
if (!$Row['active']) $Row['name'] .= ' (Ожидает модерации)';

echo '<a href="/news/material/id/'.$Row['id'].'"><div class="ChatBlock"><span>Добавил: '.$Row['added'].' | '.$Row['date'].'</span>'.$Row['name'].'</div></a>';


}
?>
</div>
</div>

<?php Footer() ?>
</div>
</body>
</html>