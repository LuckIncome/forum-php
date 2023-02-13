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



$OnlineU = mysqli_query($CONNECT, 'SELECT `user` FROM `online`'); 

$u0 = 0;
$u1 = 0;

while ($data = mysqli_fetch_assoc($OnlineU)) {
	

if ($data['user'] == 'guest') $u0 += 1;	

else {
	$u1 += 1;	
	$u_list .= '<a href="/user/login/'.$data['user'].'" class="lol">'.$data['user'].'</a>, ';
	
	
}
	
	



	
	
}

	if ($u_list) $u_list = ' [ '.substr($u_list, 0, -2).' ]';

	
	echo 'Гостей: '.$u0.' | Пользователей: '.$u1.$u_list;



?>





</div>
</div>

<?php Footer() ?>
</div>
</body>
</html>