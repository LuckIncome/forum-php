<?php 
if ($_POST['enter']) {
echo 'Запрос...';
exit;
}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Страница регистрации</title>
</head>

<body>
Заполните форму:
<form method="POST" action="/register">
<br><input type="text" name="login" required> - Логин
<br><input type="email" name="email" required> - E-Mail
<br><input type="password" name="password" required> -Пароль
<br><input type="text" name="name" required> - Имя
<br><br><input type="submit" name="enter" value="Регистрация"> <input type="reset" value="Очистить">
</form>
</body>
</html>