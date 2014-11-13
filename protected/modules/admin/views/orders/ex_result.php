    <table class="tasks" style="clear: left;" border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Название</th>
                <th>Модель</th>
                <th>Серийный номер</th>
                <th>Кол-во</th>
                <th>Ед. вим.</th>
                <th>Производитель</th>
                <th>Коментарии</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($result as $ex_result):?>
            <tr>
                    <td><?php echo $ex_result->prod_id; ?></td>
                    <td><?php echo $ex_result->models->names->name_product; ?></td>
                    <td><?php echo $ex_result->models->model_name; ?></td>
                    <td><?php echo $ex_result->prod_snum; ?></td>
                    <td><?php echo $ex_result->prod_quant; ?></td> 
                    <td><?php echo $ex_result->units->unit_name; ?></td>
                    <td><?php echo $ex_result->manufactures->manuf_name; ?></td>
                    <td><?php echo $ex_result->prod_comment; ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <?php // echo count($array_prod_id); ?>
    <?php // echo CHtml::activeTextField('array_prod_id', $array_prod_id); ?>
    <?php // foreach ($array_prod_id as $key=>$value): ?>
<div style="display:none;">
        <?php echo CHtml::textField('array_prod_id', $array_prod_id) ?>
        <?php // echo CHtml::textField("order_item_$key", $key, array('size'=>1)); ?>
        <?php // echo CHtml::textField("prod_id_$key", $value, array('size'=>1)); ?>
</div>
        <?php // echo $key.' = '.$value; ?>
    <?php // endforeach; ?>
