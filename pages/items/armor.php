<?php
$armors = getArmor($item['itemid']);
if($armors == 'empty')
{
}
else
{
foreach ($armors as $armor) {
echo '<table>
<tr><td><b><center>Armor Information</center></b></td></tr>
<tr><td>Level:</td><td>'.$armor['level'].'</td></tr>
<tr><td>Jobs:</td><td>';
$x=$armor['jobs'];
if($x==4194303)
{
echo 'All Jobs';
}
else
{
$n = 1 ;
while ( $x > 0 ) {
if ( $x & 1 == 1 ) {
echo ' '.strtoupper($jobs_array[$n]).'';
}
$n *= 2 ;
$x >>= 1 ;
}
}
echo '
</td></tr>
<tr><td>Slot(s):</td><td>'.$slot_array[$armor['slot']].'</td></tr>';
}
echo '
</table>';
}
?>