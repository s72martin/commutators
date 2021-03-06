<div class="form">
    <?php echo CHtml::beginForm(); ?> 
    <div>
        <h1 style="float: left; margin: 0 20px 0 0;">Призначення операції: 
            <?php echo CHtml::activeDropDownList($m_orders, 'status_id',
                    CHtml::listData(Status::model()->findAll(), 'status_id', 'status_name')); ?>
        </h1>
    </div>
    
    <div style="clear: left; width:600px; height: 50px; margin: 0 auto">
        <h2 style="float: left; margin: 0 20px 0 0;">Накладна № 
            <?php echo CHtml::activeTextField($m_orders, 'order_num', array('size'=>5)) ?>
        </h2>
        <h2 >від 
            <?php $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                            'name' => 'order_date',
                            'model' => $m_orders,
                            'attribute' => 'order_date',
                            'language' => 'ru',
                            'options' => array(
                                    'showAnim' => 'fold',
                            ),
                            'htmlOptions' => array(
                                    'size' => 23,
                                    'style' => 'height:20px;'
                            ),
                    )); 
            ?>
        </h2>
        
    </div>
    <div>
        <h4>Виконав переміщення: 
            <?php echo CHtml::activeDropDownList($m_orders, 'coworker_id',
                CHtml::listData(Coworkers::model()->findAll(), 'coworker_id', 'coworker_name'));?>
        </h4>
    </div>
    <div>
        <h4 style="float: left; margin: 0 20px 0 0;">Переміщено на адресу:
            <?php echo CHtml::activeDropDownList($m_orders, 'street_id' ,
                    CHtml::listData(Streets::model()->findAll(), 'street_id', 'street_name'));?>        
        </h4>
        <h4>будинок №:   
            <?php echo CHtml::activeTextField($m_orders, 'house_number', array('size'=>1)) ?>
        </h4>
    </div>
    <div>
        <h4>Коментар:
            <?php echo CHtml::activeTextField($m_orders, 'order_comment', array('size'=>50)); ?>            
        </h4>
    </div>
      
    <!-- =============================== Products ================================== -->
    <hr>
    <div id="tasks">
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
            <?php foreach ($m_products as $item) : ?>
            <tr>
                <td><?php echo $item->prod_id ?></td>
                <td><?php echo $item->models->names->name_product ?></td>
                <td><?php echo $item->models->model_name?></td>
                <td><?php echo $item->prod_snum ?></td>
                <td><?php echo $item->prod_quant ?></td> 
                <td><?php echo $item->units->unit_name ?></td>
                <td><?php echo $item->manufactures->manuf_name ?></td>
                <td><?php echo $item->prod_comment ?></td>
           </tr>
           <?php endforeach;?>
        </tbody>
</table>
    </div>
    
    <div class="row buttons" style="clear: left">
        <?php echo CHtml::submitButton('Создать'); ?>
    </div>
</div>

