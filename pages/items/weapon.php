<?php
$weapons = getWeapon($item['itemid']);
if($weapons == 'empty')
{
}
else
{
foreach ($weapons as $weapon) {
echo '<table>
<tr><td><b>Weapon Information</b></td></tr>
<tr><td>Damage Type:</td><td>'.$damage[$weapon['dmgType']].'</td></tr>
<tr><td>Hits:</td><td>'.$weapon['hit'].'</td></tr>
<tr><td>Delay:</td><td>'.$weapon['delay'].'</td></tr>
<tr><td>Damage:</td><td>'.$weapon['dmg'].'</td></tr>
<tr><td>Points to Unlock:</td><td>'.$weapon['unlock_points'].'</td></tr>';
}
echo '</table>';
}
?>