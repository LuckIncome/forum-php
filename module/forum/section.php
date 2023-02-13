<?php 

$Param['id'] += 0;

if (!preg_match('/^[1-5]{1,1}$/', $Param['id'])) NotFound();


Head('Раздел') ?>
<body>
<div class="wrapper">
<div class="header"></div>
<div class="content">
<?php Menu();
MessageShow() 
?>
<table>
<tr><th>Тема</th><th>Дата создания</th><th>Автор</th><th>Последнее сообщение</th></tr>


<?php




$Count = mysqli_fetch_row(mysqli_query($CONNECT, 'SELECT COUNT(`id`) FROM `forum` WHERE `section` = '.$Param['id']));



if (!$Param['page']) {
$Param['page'] = 1;
$Result = mysqli_query($CONNECT, 'SELECT * FROM `forum` WHERE `section` = '.$Param['id'].' ORDER BY `id` DESC LIMIT 0, 5');
} else {
$Start = ($Param['page'] - 1) * 5;
$Result = mysqli_query($CONNECT, str_replace('START', $Start, 'SELECT * FROM `forum` WHERE `section` = '.$Param['id'].' ORDER BY `id` DESC LIMIT START, 5'));
}







PageSelector('/forum/main/section/'.$Param['id'].'/page/', $Param['page'], $Count);

while ($Row = mysqli_fetch_assoc($Result)) {

echo '<tr><td><a href="/forum/topic/id/'.$Row['id'].'">'.$Row['name'].'</a></td><td>'.$Row['date'].'</td><td>'.$Row['author'].'</td><td>'.$Row['last_post'].'</td></tr>';


}
?>




</table>
</div>
<?php Footer() ?>
</div>
</body>
</html>