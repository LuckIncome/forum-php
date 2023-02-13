<?php 
Head('Новости');
?>
<body>
<div class="wrapper">
<div class="header"></div>
<div class="content">
<?php Menu();
MessageShow() 
?>
<div class="Page">
<?php echo 'Новость: '.$Param['id'] ?>
</div>
</div>

<?php Footer() ?>
</div>
</body>
</html>