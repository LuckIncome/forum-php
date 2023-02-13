<?php Head('Форум') ?>
<body>
<div class="wrapper">
<div class="header"></div>
<div class="content">
<?php Menu();
MessageShow() 
?>


<table>
<tr><th><a href="/forum/add">Создать тему</a></th><th>Последнее сообщение</th><th>Обновленная тема</th></tr>
<?


$section = array(
	1 => 'Раздел 1',
	2 => 'Раздел 2',
	3 => 'Раздел 3',
	4 => 'Раздел 4',
	5 => 'Раздел 5'
);



foreach ($section as $id => $name) {


	$upd = mysqli_fetch_assoc(mysqli_query($CONNECT, "SELECT `id`, `last_post`, `last_update`, `name` FROM `forum` WHERE `section` = $id ORDER BY `last_update` DESC LIMIT 1"));

	if ( $upd )
		echo '<tr><td><a href="/forum/section/id/'.$id.'">'.$name.'</a></td><td>от: <b>'.$upd['last_post'].'</b></td><td>Тема: <a href="/forum/topic/id/'.$upd['id'].'">'.$upd['name'].'</a><p>Дата: <b>'.$upd['last_update'].'</b></p></td></tr>';



}
?>



</table>

</div>

<?php Footer() ?>
</div>
</body>
</html>