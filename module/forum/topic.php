<?php 
$Param['id'] += 0;

$topic = mysqli_fetch_assoc(mysqli_query($CONNECT, "SELECT `name` FROM `forum` WHERE `id` = $Param[id]"));
if (!$topic) NotFound();

Head('Раздел') ?>
<body>
<div class="wrapper">
<div class="header"></div>
<div class="content">
<?php Menu();
MessageShow() 
?>

<table class="table_right">

<tr><th><?=$topic['name']?></th></tr>

<?php




$Count = mysqli_fetch_row(mysqli_query($CONNECT, 'SELECT COUNT(`id`) FROM `forump` WHERE `topic` = '.$Param['id']));



if (!$Param['page']) {
$Param['page'] = 1;
$Result = mysqli_query($CONNECT, 'SELECT * FROM `forump` WHERE `topic` = '.$Param['id'].' ORDER BY `id` LIMIT 0, 5');
} else {
$Start = ($Param['page'] - 1) * 5;
$Result = mysqli_query($CONNECT, str_replace('START', $Start, 'SELECT * FROM `forump` WHERE `topic` = '.$Param['id'].' ORDER BY `id` LIMIT START, 5'));
}






while ($Row = mysqli_fetch_assoc($Result)) {

echo '<tr><td>'.$Row['text'].'</td></tr>';

}
?>


<?php 

if ($_SESSION['USER_LOGIN_IN']) echo '<tr><td>
<form method="POST" action="/forum/add/id/'.$Param['id'].'">
<textarea class="ChatMessage" name="text" placeholder="Текст сообщения" required></textarea>
<br><input type="submit" name="add_message" value="Отправить"> <input type="reset" value="Очистить">
</form>
</td></tr>';

?>

<tr><td><?=PageSelector('/forum/topic/id/'.$Param['id'].'/page/', $Param['page'], $Count)?></td></tr>


</table>





</div>

<?php Footer() ?>
</div>
</body>
</html>