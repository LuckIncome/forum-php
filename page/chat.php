<?php 
ULogin(1);

if ($_POST['enter'] and $_POST['text'] and $_POST['captcha']) {
$_POST['text'] = FormChars($_POST['text']);

if (preg_match ('/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i', $_POST['text'])) MessageSend(1, 'Ссылки запрещены.');

$_POST['captcha'] = FormChars($_POST['captcha']);
if ($_SESSION['captcha'] != md5($_POST['captcha'])) MessageSend(1, 'Капча введена не верно.');
mysqli_query($CONNECT, "INSERT INTO `chat`  VALUES ('', '$_POST[text]', '$_SESSION[USER_LOGIN]', NOW())");
Location('/chat');
}

Head('Чат');
?>
<body>
<div class="wrapper">
<div class="header"></div>
<div class="content">
<?php Menu();
MessageShow() 
?>
<div class="Page">


<div class="ChatBox">
<?php
$Query = mysqli_query($CONNECT, 'SELECT * FROM `chat` ORDER By `time` DESC LIMIT 50');
while ($Row = mysqli_fetch_assoc($Query)) echo '<div class="ChatBlock"><span>'.$Row['user'].' | '.$Row['time'].'</span>'.$Row['message'].'</div>';
?>
</div>




<form method="POST" action="/chat">
<textarea class="ChatMessage" name="text" placeholder="Текст сообщения" required></textarea>
<div class="capdiv"><input type="text" class="capinp" name="captcha" placeholder="Капча" maxlength="10" pattern="[0-9]{1,5}" title="Только цифры." required> <img src="/resource/captcha.php" class="capimg" alt="Каптча"></div>
<br><input type="submit" name="enter" value="Отправить"> <input type="reset" value="Очистить">
</form>
</div>
</div>

<?php Footer() ?>
</div>
</body>
</html>