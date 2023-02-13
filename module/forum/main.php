<?php Head('Форум') ?>
<body>
<div class="wrapper">
<div class="header"></div>
<div class="content">
<?php Menu();
MessageShow() 
?>


<table>
<tr><th>Разделы</th><th>Последнее сообщение</th><th>Обновленная тема</th></tr>
<tr><td><a href="/forum/section/id/1">Раздел 1</a></td><td>User123</td><td>10.05.2016</td></tr>
<tr><td><a href="/forum/section/id/2">Раздел 1</a></td><td>-</td><td>-</td></tr>
<tr><td><a href="/forum/section/id/3">Раздел 3</a></td><td>-</td><td>-</td></tr>
<tr><td><a href="/forum/section/id/4">Раздел 4</a></td><td>-</td><td>-</td></tr>
<tr><td><a href="/forum/section/id/5">Раздел 5</a></td><td>-</td><td>-</td></tr>
</table>

</div>

<?php Footer() ?>
</div>
</body>
</html>