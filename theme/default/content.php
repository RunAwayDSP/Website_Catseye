<?php
$chars = getCharacterList($users['id']);
if ($chars == 'error'){}
elseif ($chars == 'empty'){}
else{
if(isset($_GET['p'])){
$page=$_GET['p'];
}else{
$page=false;
}
switch($page){
case !empty($page):
if (file_exists(BASE_FOLDER ."pages/".$page."/body.php")){
require_once("p/content.php");
}else{
require_once("p/home.php");
}
break;
default:
require_once("p/home.php");
break;
}
}
?>