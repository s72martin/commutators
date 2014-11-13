    <table style="clear: left;" border="1">
        <thead>
            <tr>
                <th>Пор.№</th>
                <th>ID</th>
                <th>Название</th>
                <th>Модель</th>
                <th>Серийный номер</th>
                <th>Кол-во</th>
                <th>Ед. вим.</th>
                <th>Производитель</th>
                <th>Дод. інформація</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($m_products as $key=>$ex_result):?>
            <tr>
                    <td><?php $key = $key+1; echo $key;?></td>
                    <td id="serial_num_<?=$key?>"><?php echo $ex_result->prod_id; ?></td>
                    <td><?php echo $ex_result->models->names->name_product; ?></td>
                    <td><?php echo $ex_result->models->model_name; ?></td>
                    <td><?php echo CHtml::link($ex_result->prod_snum, array('orders/change', 'prod_id'=>$ex_result->prod_id)); ?></td>
                    <td><?php echo $ex_result->prod_quant; ?></td> 
                    <td><?php echo $ex_result->units->unit_name; ?></td>
                    <td><?php echo $ex_result->manufactures->manuf_name; ?></td>
                    <!--<td><?php // echo $ex_result->prod_comment; ?></td>-->
                    <td><a href="#" class="serial_num_<?=$key?>">більше інформації</a></td>
            </tr>

            <?php endforeach; ?>

        </tbody>
    </table>


<?php Yii::app()->clientScript->registerCoreScript("jquery")?>
<script>
    $(document).ready(function() {
        var prod_id;
        $("a[class*='serial_num']").click(function() {
            var result = $(this).attr('class');
            prod_id = $('#'+result).text();
//            alert(prod_id);
            $.get('Informremove', {prod_id: prod_id}, function(data) {
//                $('#add').html(data);
                $.fancybox({content:data});
            });
        });

    });
</script>