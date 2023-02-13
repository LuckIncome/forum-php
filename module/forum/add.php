<?php 


if ($_POST['enter']) {
	

if (!preg_match('/^[1-5]{1,1}$/', $_POST['section'])) MessageSend(1, 'Секция форума указана не верно');


$_POST['name'] = mysqli_real_escape_string($CONNECT, $_POST['name']);
$_POST['text'] = mysqli_real_escape_string($CONNECT, $_POST['text']);

mysqli_query($CONNECT, "INSERT INTO `forum`  VALUES ('', $_POST[section], NOW(), 0, '$_POST[name]', '$_SESSION[USER_LOGIN]', '$_SESSION[USER_LOGIN]', NOW())");

$id = mysqli_insert_id($CONNECT);

mysqli_query($CONNECT, "INSERT INTO `forump`  VALUES ('', $id, NOW(), '$_POST[text]', '$_SESSION[USER_LOGIN]')");

MessageSend(2, 'Тема добавлена', '/forum');



}





else if ($_POST['add_message']) {
$Param['id'] += 0;

$_POST['text'] = mysqli_real_escape_string($CONNECT, $_POST['text']);

if (!mysqli_fetch_assoc(mysqli_query($CONNECT, "SELECT `id` FROM `forum` WHERE `id` = $Param[id]"))) MessageSend(2, 'Тема не найдена', '/forum');

mysqli_query($CONNECT, "INSERT INTO `forump`  VALUES ('', $Param[id], NOW(), '$_POST[text]', '$_SESSION[USER_LOGIN]')");


mysqli_query($CONNECT, "UPDATE `forum` SET `last_update` = NOW(), `last_post` = '$_SESSION[USER_LOGIN]' WHERE `id` = $Param[id]");

MessageSend(2, 'Сообщение добавлено', "/forum/topic/id/$Param[id]");

}




Head('Добавить тему') ?>
<body>
<div class="wrapper">
<div class="header"></div>
<div class="content">
<?php Menu();
MessageShow() 
?>
<div class="Page">
<form method="POST" action="/forum/add">
<input type="text" name="name" placeholder="Название темы" required>
<br><select size="1" name="section"><option value="1">Раздел 1</option><option value="2">Раздел 2</option><option value="3">Раздел 3</option><option value="4">Раздел 4</option><option value="5">Раздел 5</option></select>
<br><textarea class="Add" name="text" required></textarea>
<br><input type="submit" name="enter" value="Добавить"> <input type="reset" value="Очистить">
</form>
</div>
</div>

<?php Footer() ?>
</div>
</body>
</html>