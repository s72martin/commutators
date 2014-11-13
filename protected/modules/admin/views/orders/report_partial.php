<tr>
            <?php foreach($ex_result as $key=>$item){
                    if($key == order_date) {
                      echo '<td>'.date("d.m.Y", $item).'</td>';
                    } else {
                      echo '<td>'.$item.'</td>'; 
                    }
            } ?>
</tr>
