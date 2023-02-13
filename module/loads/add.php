<?php 
if ($_SESSION['USER_GROUP'] == 2) $Active = 1;
else $Active = 0;
if ($_POST['enter'] and $_POST['text'] and $_POST['name'] and $_POST['cat']) {
if ($_FILES['img']['type'] != 'image/jpeg') MessageSend(2, 'Не верный тип изображения.');
if ($_FILES['file']['type'] != 'application/octet-stream') MessageSend(2, 'Не верный тип файла.');
$_POST['name'] = FormChars($_POST['name']);
$_POST['text'] = FormChars($_POST['text']);
$_POST['cat'] += 0;

$MaxId = mysqli_fetch_row(mysqli_query($CONNECT, 'SELECT max(`id`) FROM `load`'));
$MaxId[0] += 1;

foreach(glob('catalog/img/*', GLOB_ONLYDIR) as $num => $Dir) {
$num_img ++;
$Count = sizeof(glob($Dir.'/*.*'));
if ($Count < 250) {
move_uploaded_file($_FILES['img']['tmp_name'], $Dir.'/'.$MaxId[0].'.jpg');
break;
}
}


foreach(glob('catalog/file/*', GLOB_ONLYDIR) as $num => $Dir) {
$num_file ++;
$Count = sizeof(glob($Dir.'/*.*'));
if ($Count < 250) {
move_uploaded_file($_FILES['file']['tmp_name'], $Dir.'/'.$MaxId[0].'.zip');
break;
}
}

mysqli_query($CONNECT, "INSERT INTO `load`  VALUES ('', '$_POST[name]', $_POST[cat], 0, 0, '$_SESSION[USER_LOGIN]', '$_POST[text]', NOW(), $Active, $num_img, $num_file)");
MessageSend(2, 'Файл добавлен', '/loads');
}
Head('Добавить файл') ?>
<body>
<div class="wrapper">
<div class="header"></div>
<div class="content">
<?php Menu();
MessageShow() 
?>
<div class="Page">
<form method="POST" action="/loads/add" enctype="multipart/form-data">
<input type="text" name="name" placeholder="Название материала" required>
<br><select size="1" name="cat"><option value="1">Категория 1</option><option value="2">Категория 2</option><option value="3">Категория 3</option></select>
<br><input type="file" name="file"> (Файл)
<br><input type="file" name="img"> (Изображение)
<br><textarea class="Add" name="text" required></textarea>
<br><input type="submit" name="enter" value="Добавить"> <input type="reset" value="Очистить">
</form>
</div>
</div>

<?php Footer() ?>
</div>
</body>
</html>