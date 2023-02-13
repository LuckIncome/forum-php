<?php 
if ($_POST['enter']) {
echo 'Запрос...';
exit;
}

Head('Вход') ?>
<body>
<div class="wrapper">
<div class="header"></div>
<div class="content">
<?php Menu() ?>
<div class="Page">
<form method="POST" action="/login">
<br><input type="text" name="login" placeholder="Логин" required>
<br><input type="password" name="password" placeholder="Пароль" required>
<br><br><input type="submit" name="enter" value="Вход"> <input type="reset" value="Очистить">
</form>
</div>
</div>

<?php Footer() ?>
</div>
</body>
</html>