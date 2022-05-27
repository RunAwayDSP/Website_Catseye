<form action="" method="post"><input type="text" name="name" placeholder="Enter a Item"></input>  <input type="submit" value="Search"></input></form>


<?php
if(isset($_POST['name'])){
$_POST['name']=$_POST['name'];
$_POST['name']=str_replace(" ","_",$_POST['name']);
}

if (!isset($_POST['name']))
{
}
elseif(strlen($_POST['name'])<'3')
{
echo getPanel("warning","Error","You Must enter more than 2 characters");
}
elseif(getItemList($_POST['name'])=='empty')
{
echo getPanel("warning","Error","No Items Found");
}
else
{
$name = $_POST['name'];
$item = getItemList($name);
echo '<table class="table table-striped">';
foreach ($item as $items)
{
echo '<tr><td><a href="?p=items&id='.$items['itemid'].'">'.ucwords(str_replace('_',' ',$items['sortname'])).'</a></td></tr>';
}
echo '</table>';
}