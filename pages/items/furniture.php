<?php
$furn = getFurniture($item['itemid']);
if($furn == 'empty')
{
}
else
{
foreach ($furn as $furns) {
echo '<table class="table table-sm">
<tr class="table-success"><td colspan=2><b><center>Furniture Information</center></b></td></tr>
<tr><td>Storage:</td><td>'.$furns['storage'].'</td></tr>
<tr><td>Moghancement:</td><td>'.$furns['moghancement'].'</td></tr>
<tr><td>Element:</td><td>'.$furns['element'].'</td></tr>
<tr><td>Aura:</td><td>'.$furns['aura'].'</td></tr>';		
}
echo '			
</table>';

}

?>