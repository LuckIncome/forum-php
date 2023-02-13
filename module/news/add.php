<?php 
UAccess(2);

if ($_SESSION['USER_GROUP'] == 2) $Active = 1;
else $Active = 0;
if ($_POST['enter'] and $_POST['text'] and $_POST['name'] and $_POST['cat']) {
$_POST['name'] = FormChars($_POST['name']);
$_POST['text'] = FormChars($_POST['text']);
$_POST['cat'] += 0;
mysqli_query($CONNECT, "INSERT INTO `news`  VALUES ('', '$_POST[name]', $_POST[cat], '$_SESSION[USER_LOGIN]', '$_POST[text]', NOW(), $Active, 0, '')");
MessageSend(2, 'Новость добавлена', '/news');
}
Head('Добавить новость') ?>
<body>
<div class="wrapper">
<div class="header"></div>
<div class="content">
<?php Menu();
MessageShow() 
?>
<div class="Page">
<form method="POST" action="/news/add">
<input type="text" name="name" placeholder="Название новости" required>
<br><select size="1" name="cat"><option value="1">Категория 1</option><option value="2">Категория 2</option><option value="3">Категория 3</option></select>
<br><textarea class="Add" name="text" required></textarea>
<br><input type="submit" name="enter" value="Добавить"> <input type="reset" value="Очистить">
</form>
</div>
</div>

<?php Footer() ?>
</div>
</body>
</html>