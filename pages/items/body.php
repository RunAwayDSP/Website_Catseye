<?php
if(isset($_GET['id'])){
$itemid=$_GET['id'];
$items = getItem($itemid);
$item = $items[0];
if($item['NoSale']==1){
$sell='No';
}else{
$sell='Yes';
}
$sellprice=number_format($item['BaseSell']);
$aH=$item['aH'];

require_once("basic.php");
require_once("armor.php");
require_once("weapon.php");
require_once("furniture.php");
require_once("mod.php");
require_once("latents.php");
require_once("drop.php");
}
else
{
require_once("home.php");
}
?>