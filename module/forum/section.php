<?php Head('Раздел') ?>
<body>
<div class="wrapper">
<div class="header"></div>
<div class="content">
<?php Menu();
MessageShow() 
?>
<table>
<tr><th>Тема</th><th>Дата создания</th><th>Автор</th><th>Последнее сообщение</th></tr>
<tr><td><a href="/forum/topic/id/1">Тема 1</a></td><td>10.05.2016</td><td>User123</td><td>-</td></tr>
<tr><td><a href="/forum/topic/id/2">Тема 2</a></td><td>10.05.2016</td><td>User123</td><td>-</td></tr>
<tr><td><a href="/forum/topic/id/3">Тема 3</a></td><td>10.05.2016</td><td>User123</td><td>-</td></tr>
<tr><td><a href="/forum/topic/id/4">Тема 4</a></td><td>10.05.2016</td><td>User123</td><td>-</td></tr>
<tr><td><a href="/forum/topic/id/5">Тема 5</a></td><td>10.05.2016</td><td>User123</td><td>-</td></tr>
</table>
</div>
<?php Footer() ?>
</div>
</body>
</html>