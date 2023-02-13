<?php 
if ($_POST['enter']) {
echo 'Запрос...';
exit;
}

Head('Регистрация') ?>
<body>
<div class="wrapper">
<div class="header"></div>
<div class="content">
<?php Menu() ?>
<div class="Page">
<form method="POST" action="/register">
<br><input type="text" name="login" placeholder="Логин" required>
<br><input type="email" name="email" placeholder="E-Mail" required>
<br><input type="password" name="password" placeholder="Пароль" required>
<br><input type="text" name="name" placeholder="Имя" required>
<br><input type="file" name="avatar">
<br><br><input type="submit" name="enter" value="Регистрация"> <input type="reset" value="Очистить">
</form>
</div>
</div>

<?php Footer() ?>
</div>
</body>
</html>