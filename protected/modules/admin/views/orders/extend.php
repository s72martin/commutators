<?php if($status_id == 6){ ?>
    <h1>Знаходиться в ремонті у сервісному центрі ZyXEL</h1>
<?php 
} elseif ($status_id == 3) { 
?>
    <h1>Наявність обладнання на складі</h1>
<?php } ?>
<!--<a href="#"><div id="red" style="width: 62px; height: 28px; border: 1px solid orange; border-radius: 5px; background-color: #ff0000;">Додати в накладну</div></a>-->
<div class="row buttons" style="float:right; margin: 0 10px 10px 0;">
        <?php echo CHtml::submitButton('Додати в накладну', array('class'=>'red')); ?>
</div>
<table class="tasks" style="clear: left;">
        <thead>
            <tr>
                <th>ID</th>
                <th>Тип</th>
                <th>Модель</th>
                <th>Серийный номер</th>
                <th>Выбор</th>
                <th>Кол-во</th>
                <th>Ед. вим.</th>
                <th>Производитель</th>
                <th>Коментарии</th>
                
            </tr>
        </thead>
        <tbody>
            <?php 
                $index=0; 
                foreach ($result as $item) : ?>
            <tr>
                <td id="chekbox_<?=$index?>"><?php echo $item->prod_id ?></td>
                <td><?php echo $item->models->names->name_product ?></td>
                <td><?php echo $item->models->model_name?></td>
                <td><?php echo $item->prod_snum ?></td>
                <td><?php echo CHtml::CheckBox('item', false, array('class'=>'chekbox_'.$index)) ?></td>
                <td><?php echo $item->prod_quant ?></td> 
                <td><?php echo $item->units->unit_name ?></td>
                <td><?php echo $item->manufactures->manuf_name ?></td>
                <td><?php echo $item->prod_comment ?></td>
           </tr>
           <?php
                $index++; 
                endforeach;?>
        </tbody>
</table>
<div class="row buttons" style="float:right; margin: 0 10px 10px 0;">
        <?php echo CHtml::submitButton('Додати в накладну', array('class'=>'red')); ?>
</div>
<script>
    $(document).ready(function() {
        var result;
        var item;
        var array_prod_id = [];
        $('input').change(function() {  
            result = $(this).attr('class');
            if($(this).prop("checked")) {
                item = $('#'+result).text();
                array_prod_id.push(item);
//                alert(array_prod_id);
            }
        });
        $('.red').click(function() {
            array_prod_id = JSON.stringify(array_prod_id);
//            alert(array_prod_id);
            $.get('ExtendAjax', {array_prod_id: array_prod_id}, function(data) {
                  $('#tasks').html(data);
            });
            alert('Обладнання додано успішно. Закрийте модальне вікно.');
            
        });
    });
</script>