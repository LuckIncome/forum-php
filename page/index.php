<?php Head('Пишем свой движок на PHP') ?>
<body>
<div class="wrapper">
<div class="header"></div>
<div class="content">
<?php Menu();
MessageShow() 
?>
<div class="Page">
<?php $Query = mysqli_query($CONNECT, 'SELECT `id`, `dimg`, `name` FROM `loads` ORDER BY `date` DESC LIMIT 8'); 
while ($Row = mysqli_fetch_assoc($Query)) echo '<a href="/loads/material/id/'.$Row['id'].'"><img src="/catalog/mini/'.$Row['dimg'].'/'.$Row['id'].'.jpg" class="lm" alt="'.$Row['name'].'" title="'.$Row['name'].'"></a>';
?>
</div>
</div>

<?php Footer() ?>
</div>
</body>
</html>