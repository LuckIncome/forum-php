<?php
if ($Module == 'success') MessageSend(3, 'Платеж осуществлен успешно.', '/profile');
else if ($Module == 'fail') MessageSend(1, 'Невозможно осуществить платеж.', '/profile');


$key = 'ВАШ_СЕКРЕТНЫЙ_КЛЮЧ';

if ($_POST['MERCHANT_ID'] != 'ID_Вашего_магазина') exit;


foreach($_POST as $name => $value) if ($name !== "WMI_SIGNATURE") $params[$name] = $value;
uksort($params, "strcasecmp"); $values = "";

foreach($params as $name => $value) {
$value = iconv("utf-8", "windows-1251", $value);
$values .= $value;
}

$signature = base64_encode(pack("H*", md5($values . $key)));

if ($signature != $_POST["WMI_SIGNATURE"]) exit;

if (strtoupper($_POST["WMI_ORDER_STATE"]) == 'ACCEPTED') {
$Array = explode('-', $_POST['WMI_PAYMENT_NO']);

$Row = mysqli_fetch_assoc(mysqli_query($CONNECT, "SELECT `login` FROM `users` WHERE `id` = $Array[1]"));
if ($Row['login']) mysqli_query($CONNECT, "INSERT INTO `payment` VALUES('', '$Row[login]', $_POST[WMI_PAYMENT_AMOUNT])");
exit('WMI_RESULT=OK');
}
?>