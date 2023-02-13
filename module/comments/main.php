<?php
function COMMENTS() {
global $CONNECT, $Module, $Page, $Param;
if ($_SESSION['USER_LOGIN_IN'] != 1) echo '<br><br>Оставлять комменатрии могут только зарегистрированные пользователи.';
else echo '<br><br><form method="POST" action="/comments/add/module/'.$Page.'/id/'.$Param['id'].'">
<textarea class="ChatMessage" name="text" placeholder="Текст сообщения" required></textarea>
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
while ($Row = mysqli_fetch_assoc($Result)) echo '<div class="ChatBlock"><span>'.$Row['added'].' | '.$Row['date'].'</span>'.$Row['text'].'</div>';
}
?>