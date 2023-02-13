<?php 
ULogin(0);
Head('Восстановить пароль') ?>
<body>
<div class="wrapper">
<div class="header"></div>
<div class="content">
<?php Menu();
MessageShow() 
?>
<div class="Page">
<form method="POST" action="/account/restore">
<br><input type="text" name="login" placeholder="Логин" maxlength="10" pattern="[A-Za-z-0-9]{3,10}" title="Не менее 3 и неболее 10 латынских символов или цифр." required>
<div class="capdiv"><input type="text" class="capinp" name="captcha" placeholder="Капча" maxlength="10" pattern="[0-9]{1,5}" title="Только цифры." required> <img src="/resource/captcha.php" class="capimg" alt="Каптча"></div>
<br><input type="submit" name="enter" value="Восстановить"> <input type="reset" value="Очистить">
</form>
</div>
</div>

<?php Footer() ?>
</div>
</body>
</html>