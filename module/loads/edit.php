<?php 
UAccess(2);
$Param['id'] += 0;
if (!$Param['id']) MessageSend(1, 'Не указан ID новости', '/news');
$Row = mysqli_fetch_assoc(mysqli_query($CONNECT, "SELECT `cat`, `name`, `text` FROM `news` WHERE `id` = $Param[id]"));
if (!$Row['name']) MessageSend(1, 'Новость не найдена', '/news');

if ($_POST['enter'] and $_POST['text'] and $_POST['name'] and $_POST['cat']) {
$_POST['name'] = FormChars($_POST['name']);
$_POST['text'] = FormChars($_POST['text']);
$_POST['cat'] += 0;
mysqli_query($CONNECT, "UPDATE `news` SET `name` = '$_POST[name]', `cat` = $_POST[cat], `text` = '$_POST[text]' WHERE `id` = $Param[id]");
MessageSend(2, 'Новость отредактирована.', '/news/material/id/'.$Param['id']);
}

Head('Редактировать новость') ?>
<body>
<div class="wrapper">
<div class="header"></div>
<div class="content">
<?php Menu();
MessageShow() 
?>
<div class="Page">
<?php
echo '<form method="POST" action="/news/edit/id/'.$Param['id'].'">
<input type="text" name="name" placeholder="Название новости" value="'.$Row['name'].'" required>
<br><select size="1" name="cat">'.str_replace('value="'.$Row['cat'], 'selected value="'.$Row['cat'], '<option value="1">Категория 1</option><option value="2">Категория 2</option><option value="3">Категория 3</option>').'</select>
<br><textarea class="Add" name="text" required>'.str_replace('<br>', '', $Row['text']).'</textarea>
<br><input type="submit" name="enter" value="Сохранить"> <input type="reset" value="Очистить">
</form>'
?>
</div>
</div>

<?php Footer() ?>
</div>
</body>
</html>