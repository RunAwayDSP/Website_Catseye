<?php
$mods = getMods($item['itemid']);
if($mods == 'empty')
{
}else
{
echo '<table">
<tr><td><b><center>Mod Information</center></b></td></tr>';
foreach ($mods as $mod) {
echo '
<tr><td>'.strtoupper(str_replace('_',' ',$mod_name[$mod['modId']])).'</td><td>'.$mod['value'].'</td></tr>';
}
echo '			
</table>';
}
?>