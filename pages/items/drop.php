<?php
$drops = getItemDrops($item['itemid']);
if($drops == 'empty')
{
}
else
{
echo '<table>
<tr><td><b><center>Drop Information</center></b></td></tr>';
foreach ($drops as $drop) {
$droptype=$drop['dropType'];
$rate=$drop['itemRate']/10;
if(!$drop['name'])
{
}
else
{
echo '
<tr>
<td>'.$drop['name'].'</td>
<td>'.getZoneName($drop['zoneid']).'</td>
<td>'.$rate.'%</td><td>'.$droptype_array[$droptype].'</td>
</tr>';
}
}
echo '
</table>';
}

?>