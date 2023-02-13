<?php 
ULogin(1);

if ($_POST['enter'] and $_POST['text'] and $_POST['login']) {
Uaccess(2);
SendMessage($_POST['login'], $_POST['text']);
MessageSend(3, 'Сообщение отправлено');
}

Head('Отправить сообщение');
?>
<body>
<div class="wrapper">
<div class="header"></div>
<div class="content">
<?php Menu();
MessageShow() 
?>
<div class="Page">
<a href="/pm/dialog" class="lol">МОИ ДИАЛОГИ</a><br><br>
<form method="POST" action="/pm/send">
<input type="text" name="login" placeholder="Логин получателя" required>
<br><textarea class="ChatMessage" name="text" placeholder="Текст сообщения" required></textarea>
<br><input type="submit" name="enter" value="Отправить"> <input type="reset" value="Очистить">
</form>
</div>
</div>

<?php Footer() ?>
</div>
</body>
</html>