<?php Head('Регистрация') ?>
<body>
<div class="wrapper">
<div class="header"></div>
<div class="content">
<?php Menu() ?>
<div class="Page">
<form method="POST" action="/account/register">
<br><input type="text" name="login" placeholder="Логин">
<br><input type="email" name="email" placeholder="E-Mail" required>
<br><input type="password" name="password" placeholder="Пароль" required>
<br><input type="text" name="name" placeholder="Имя" required>
<br><select size="1" name="country"><option value="0">Не скажу</option><option value="1">Украина</option><option value="2">Россия</option><option value="3">США</option><option value="4">Канада</option></select>
<br><input type="file" name="avatar">
<br><br><input type="submit" name="enter" value="Регистрация"> <input type="reset" value="Очистить">
</form>
</div>
</div>

<?php Footer() ?>
</div>
</body>
</html>