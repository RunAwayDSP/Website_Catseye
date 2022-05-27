<?php 
 echo '<table>
<tr><td><b><center>Basic Information</center></b></td></tr>
<tr><td>Name:</td><td>'.ucwords(str_replace('_',' ',$item['sortname'])).'</td></tr>
<tr><td>Item ID:</td><td>'.$item['itemid'].'</td></tr>
<tr><td>Stack Size:</td><td>'.$item['stackSize'].'</td></tr>
<tr><td>Sell Price:</td><td>'.$sellprice.' Gil</td></tr>
<tr><td>Sellable:</td><td>'.$sell.'</td></tr>
<tr><td>Flags:</td><td>';
 $x=$item['flags'];
   $n = 1 ;
    while ( $x > 0 ) {
        if ( $x & 1 == 1 ) {
            echo ' '.$flag_array[$n].', ';
        }
        $n *= 2 ;
        $x >>= 1 ;
    }
if ($x==0){
	echo 'None';
}
echo '
</td></tr>
<tr><td>AH Category:</td><td>'.$ahcat[$aH].'</td></tr>
</table>';