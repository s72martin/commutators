
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
                <th>Коментарии</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($m_products as $key=>$ex_result):?>
                <?php // echo $key; ?>
                <tr class="change<?=$key?>">
                    <td><?php $key = $key+1; echo $key;?></td>
                    <td  id="change<?=$key?>"><?php echo $ex_result->prod_id; ?></td>
                    <td><?php echo $ex_result->models->names->name_product; ?></td>
                    <td><?php echo $ex_result->models->model_name; ?></td>
                    <td><?php echo CHtml::link($ex_result->prod_snum, array('orders/change', 
                                            'prod_id'=>$ex_result->prod_id)); ?></td>
                    <td><?php echo $ex_result->prod_quant; ?></td> 
                    <td><?php echo $ex_result->units->unit_name; ?></td>
                    <td><?php echo $ex_result->manufactures->manuf_name; ?></td>
                    <td><?php echo $ex_result->prod_comment; ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php Yii::app()->clientScript->registerCoreScript("jquery")?>
<script>
    $(document).ready(function(){
        var array_prod_id = [];
        $('tr').click(function(){
            var result = $(this).attr('class');
            var item = $('#'+result).text();
            array_prod_id.push(item);
            array_prod_id = JSON.stringify(array_prod_id);
//            alert(array_prod_id);
        });
        $.get('ExtendAjax', {array_prod_id: array_prod_id}, function(data) {
                  $('#tasks').html(data);
            });
    });
 </script>