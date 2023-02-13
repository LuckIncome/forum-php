<?php 
ULogin(1);
Head('Профиль пользователя '.$_SESSION['USER_LOGIN']) 
?>
<body>
<div class="wrapper">
<div class="header"></div>
<div class="content">
<?php Menu();
MessageShow() 
?>
<div class="Page">

<?php
echo "
Идентификатор: $_SESSION[USER_LOGIN_IN]
<br>ID: $_SESSION[USER_ID]
<br>Логин: $_SESSION[USER_LOGIN]
<br>Пароль: $_SESSION[USER_PASSWORD]
<br>Дата регистраци: $_SESSION[USER_REGDATE]
<br>E-mail: $_SESSION[USER_EMAIL]
<br>Страна: $_SESSION[USER_COUNTRY]
<br>Аватар: $_SESSION[USER_AVATAR]
";
?>

</div>
</div>

<?php Footer() ?>
</div>
</body>
</html>