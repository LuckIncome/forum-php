<?php 
function SetLang($p1) {
if (!in_array($p1, array('ru', 'en'))) $p1 = 'en';
$_SESSION['USER_LANGUAGE'] = $p1;	
}



if (!$_SESSION['USER_LANGUAGE']) SetLang(substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2));
include "resource/language/$_SESSION[USER_LANGUAGE].php";





if ($Module) { 
SetLang($Module); 
Location('/language'); 
}





Head('Мультиязычность') ?>
<body>
<div class="wrapper">
<div class="header"></div>
<div class="content">
<?php Menu();
MessageShow() 
?>
<div class="Page">
<a href="/language/ru" class="lol">Русский язык</a> | <a href="/language/en" class="lol">Английский язык</a>

<?php 

echo '<br><br>'.L1.'<br>'.L2;


?>

</div>
</div>

<?php Footer() ?>
</div>
</body>
</html>