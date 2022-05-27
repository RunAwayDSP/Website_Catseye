<?php
$latents = getLatents($item['itemid']);
if($latents == 'empty')
{
}
else
{
echo '<table>
<tr><td colspan=4><b><center>Latent Mod Information</center></b></td></tr>
<tr><td>Mod</td><td>Value</td><td>Latent</td><td>Parameter</td></tr>';
foreach ($latents as $latent) {
echo '
<tr><td>'.strtoupper(str_replace('_',' ',$mod_name[$latent['modId']])).'</td><td>'.$latent['value'].'</td><td>'.strtoupper(str_replace('_',' ',$latent_name[$latent['latentId']])).'</td><td>'.$latent['latentParam'].'</td></tr>';
}
echo '
</table>';
}
?>