<tr>
    <td><?php echo $ex_result->prod_id; ?></td>
    <td><?php echo $ex_result->models->names->name_product; ?></td>
    <td><?php echo $ex_result->models->model_name; ?></td>
    <td><?php echo CHtml::link($ex_result->prod_snum, array('orders/remove', 'prod_id'=>$ex_result->prod_id)); ?></td>
    <td><?php echo $ex_result->prod_quant; ?></td> 
    <td><?php echo $ex_result->units->unit_name; ?></td>
    <td><?php echo $ex_result->manufactures->manuf_name; ?></td>
    <td><?php echo $ex_result->street_kod; ?></td>
</tr>