<?php 
if ($Module == 'category' and $Param['id'] != 1 and $Param['id'] != 2 and $Param['id'] != 3) MessageSend(1, 'Такой категории не существует.', '/news');
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
<a href="/news"><div class="Cat">Все категории</div></a>
<a href="/news/category/id/1"><div class="Cat">Категория 1</div></a>
<a href="/news/category/id/2"><div class="Cat">Категория 2</div></a>
<a href="/news/category/id/3"><div class="Cat">Категория 3</div></a>
</div>

<div class="Page">
<?php 
if (!$Module or $Module == 'main') {
$Param1 = 'SELECT `id`, `name`, `added`, `date` FROM `news` ORDER BY `id` DESC LIMIT 0, 5';
} else if ($Module == 'category') {
$Param1 = 'SELECT `id`, `name`, `added`, `date` FROM `news` WHERE `cat` = '.$Param['id'].' ORDER BY `id` DESC LIMIT 0, 5';
}


$Query = mysqli_query($CONNECT, $Param1);
while ($Row = mysqli_fetch_assoc($Query)) echo '<a href="/news/material/id/'.$Row['id'].'"><div class="ChatBlock"><span>Добавил: '.$Row['added'].' | '.$Row['date'].'</span>'.$Row['name'].'</div></a>';
?>
</div>
</div>

<?php Footer() ?>
</div>
</body>
</html>