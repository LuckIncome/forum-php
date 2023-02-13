<?php 
if (!in_array($Module, array('news', 'loads'))) MessageSend(1, 'Модуль не найден.', '/');


if ($_POST['enter']) {
$_SESSION['SEARCH'] = FormChars($_POST['text']);
exit(header('location: /search/'.$Module));
}


if (!$_SESSION['SEARCH']) MessageSend(1, 'Слово для поиска не указано.', '/');
Head('Чат');
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
$Count = mysqli_fetch_row(mysqli_query($CONNECT, "SELECT COUNT(`id`) FROM `$Module` WHERE `name` LIKE '%$_SESSION[SEARCH]%'"));


if ($Count[0]) {
if (!$Param['page']) {
$Param['page'] = 1;
$Result = mysqli_query($CONNECT, "SELECT `id`, `name`, `date` FROM `$Module` WHERE `name` LIKE '%$_SESSION[SEARCH]%' ORDER BY `id` DESC LIMIT 0, 5");
} else {
$Start = ($Param['page'] - 1) * 5;
$Result = mysqli_query($CONNECT, str_replace('START', $Start, "SELECT `id`, `name`, `date` FROM `$Module` WHERE `name` LIKE '%$_SESSION[SEARCH]%' ORDER BY `id` DESC LIMIT START, 5"));
}


PageSelector("/search/$Module/page/", $Param['page'], $Count);
while ($Row = mysqli_fetch_assoc($Result)) echo '<a href="/'.$Module.'/material/id/'.$Row['id'].'"><div class="ChatBlock"><span>Добавлен: '.$Row['date'].'</span>'.$Row['name'].'</div></a>';
PageSelector("/search/$Module/page/", $Param['page'], $Count);
} else echo 'Ничего не найдено.';
?>



</div>
</div>

<?php Footer() ?>
</div>
</body>
</html>