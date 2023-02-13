<?php

if ($_SESSION['USER_LOGIN_IN'] != 1) echo '<br><br>Оставлять комменатрии могут только зарегистрированные пользователи.';
else echo '<br><br><form method="POST" action="/comments/add/module/'.$Page.'/id/'.$Param['id'].'">
<textarea class="ChatMessage" name="text" placeholder="Текст сообщения" required></textarea>
<div class="capdiv"><input type="text" class="capinp" name="captcha" placeholder="Капча" maxlength="10" pattern="[0-9]{1,5}" title="Только цифры." required> <img src="/resource/captcha.php" class="capimg" alt="Каптча"></div>
<br><input type="submit" name="enter" value="Отправить"> <input type="reset" value="Очистить">
</form>';

$ID = ModuleID($Page);
$Count = mysqli_fetch_row(mysqli_query($CONNECT, 'SELECT COUNT(`id`) FROM `comments` WHERE `module` = '.$ID.' AND `material` = '.$Param['id']));

if (!$Param['page']) {
$Param['page'] = 1;
$Result = mysqli_query($CONNECT, 'SELECT `id`, `added`, `date`, `text` FROM `comments` WHERE `module` = '.$ID.' AND `material` = '.$Param['id'].' ORDER BY `id` DESC LIMIT 0, 5');
} else {
$Start = ($Param['page'] - 1) * 5;
$Result = mysqli_query($CONNECT, str_replace('START', $Start, 'SELECT `id`, `added`, `date`, `text` FROM `comments` WHERE `module` = '.$ID.' AND `material` = '.$Param['id'].' ORDER BY `id` DESC LIMIT START, 5'));
}

PageSelector("/$Page/$Module/id/$Param[id]/page/", $Param['page'], $Count);


while ($Row = mysqli_fetch_assoc($Result)) {
if ($_SESSION['USER_GROUP'] == 2) $Admin = ' | <a href="/comments/control/action/delete/id/'.$Row['id'].'" class="lol">Удалить</a> | <a href="/comments/control/action/edit/id/'.$Row['id'].'" class="lol">Редактировать</a>';
if ($Row['id'] == $_SESSION['COMMENTS_EDIT']) $Row['text'] = '<form method="POST" action="/comments/control"><textarea class="ChatMessage" name="text" placeholder="Текст сообщения" required>'.$Row['text'].'</textarea><br><input type="submit" name="save" value="Сохранить"> <input type="submit" name="cancel" value="Отменить"> <input type="reset" value="Очистить"></form>';
echo '<div class="ChatBlock"><span>'.$Row['added'].' | '.$Row['date'].$Admin.'</span>'.$Row['text'].'</div>';
}


?>