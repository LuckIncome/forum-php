<?php 
ULogin(0);
Head('Регистрация') ?>
<body>
<div class="wrapper">
<div class="header"></div>
<div class="content">
<?php Menu();
MessageShow() 
?>
<div class="Page">
<form method="POST" action="/account/register">
<br><input type="text" name="login" placeholder="Логин" maxlength="10" pattern="[A-z0-9]{3,10}" title="Логин может содержать только латинские буквы и цифры, длиной от 3 до 10 символов" required>
<br><input type="email" name="email" placeholder="E-Mail" required>
<br><input type="password" name="password" placeholder="Пароль" maxlength="15" pattern="[A-z0-9]{5,15}" title="Пароль может содержать только латинские буквы и цифры, длиной от 3 до 10 символов" required>
<br><input type="text" name="name" placeholder="Имя" maxlength="10" pattern="[А-я]{3,10}" title="Имя может содержать только русские буквы, длиной от 3 до 10 символов" required>
<br><select size="1" name="country"><option value="0">Не скажу</option><option value="1">Украина</option><option value="2">Россия</option><option value="3">США</option><option value="4">Канада</option></select>
<div class="capdiv"><input type="text" class="capinp" name="captcha" placeholder="Капча" maxlength="10" pattern="[0-9]{1,5}" title="Только цифры" required> <img src="/resource/captcha.php" class="capimg" alt="Каптча"></div>
<br><input type="submit" name="enter" value="Регистрация"> <input type="reset" value="Очистить">
</form>
</div>
</div>

<?php Footer(); ?>
</div>
</body>
</html>