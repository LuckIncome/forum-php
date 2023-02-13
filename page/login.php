<?php 
if ($_POST['enter']) {
echo 'Запрос на логин...';
exit;
}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Страница Входа</title>
</head>

<body>
Заполните форму:
<form method="POST" action="/login">
<br><input type="text" name="login" required> - Логин
<br><input type="password" name="password" required> -Пароль
<br><br><input type="submit" name="enter" value="Вход"> <input type="reset" value="Очистить">
</form>
</body>
</html>