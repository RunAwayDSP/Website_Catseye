<?php
$chars = getCharacterList($users['id']);
echo '<table>';
foreach ($chars as $char) {
echo '<tr"><td>'.$char['charname'].'</td></tr>';
$delivery=getCharacterDBox($char['charid']);
if($delivery!='empty'){
foreach($delivery as $dbox){
if($dbox[4]==65535){
echo '<tr>
<td><img src=https://static.ffxiah.com/images/icon/'.$dbox[4].'.png alt=Gil height=32 width=32>Gil</td>
<td>'.number_format($dbox[6]).'</td>
<td>'.$dbox[9].'</td></tr>
';
}
else{
echo '<tr>
<td><img src=https://static.ffxiah.com/images/icon/'.$dbox[4].'.png alt='.ucwords(str_replace('_',' ',getItemName($dbox[4]))).' height=32 width=32>'.ucwords(str_replace('_',' ',getItemName($dbox[4]))).'</td>
<td>'.number_format($dbox[6]).'</td><td>'.$dbox[9].'</td></tr>';
}
}
}
}
echo '</table>';
?>