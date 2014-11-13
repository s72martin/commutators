<?php if(Yii::app()->user->hasFlash('orders')): ?>
<div class="flash-success">
    <?php echo Yii::app()->user->getFlash('orders'); ?>
</div>
<?php endif; ?>
<div class="form">
    <?php echo CHtml::beginForm(); ?> 
    <div>
        <h1 style="float: left; margin: 0 20px 0 0;">Призначення операції: 
            <?php echo CHtml::activeDropDownList($m_orders, 'status_id',
                    CHtml::listData(Status::model()->findAll(), 'status_id', 'status_name'), array('empty'=>'ВИБЕРІТЬ ОПЕРАЦІЮ', 'class'=>'purpose')); ?>
        </h1>
    </div>
    
    <div style="clear: left; width:600px; height: 50px; margin: 0 auto">
        <h2 style="float: left; margin: 0 20px 0 0;">Накладна № 
            <?php echo CHtml::activeTextField($m_orders, 'order_num', array('size'=>10)) ?>
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
        <h4>Отримав: 
            <?php echo CHtml::activeDropDownList($m_orders, 'coworker_id',
                CHtml::listData(Coworkers::model()->findAll(), 'coworker_id', 'coworker_name'));?>
        </h4>
    </div>
    <div>
        <h4 style="float: left; margin: 0 20px 0 0;">Встановлено на адресу:
            <?php echo CHtml::activeDropDownList($m_orders, 'street_id',
                    CHtml::listData(Streets::model()->findAll(), 'street_id', 'street_name'));?>        
        </h4>
        <h4>будинок №:   
            <?php echo CHtml::activeTextField($m_orders, 'house_number', array('size'=>3)) ?>
        </h4>
    </div>
    <div>
        <h4>Коментар:
            <?php echo CHtml::activeTextField($m_orders, 'order_comment', array('size'=>50)); ?>            
        </h4>
    </div>
      
    <!-- =============================== Products ================================== -->
    <hr>
    <div class="row buttons" style="clear: left">
        <h2>Склад:
            <?php echo CHtml::activeDropDownList($m_orders, 'stockroom_id',
                    CHtml::listData(Stockrooms::model()->findAll(), 'stockroom_id', 'stockroom_name'), 
                    array('id'=>'models_form','empty'=>'Виберіть склад')); ?>
        </h2>
        <?php 
        
//             echo CHtml::dropDownList('models', 'model_id', array(
//                                            '1' => 'ES-2108-G',
//                                            '2' => 'ES-2024A',
//                                            '3' => 'MES-3528',
//                                            '4' => 'GS-3012F',
//                                            '5' => 'GS-4012F',
//                                            '6' => 'XGS-4728F',
//                                            '7' => 'MES3500-24',
//                                            '8' => 'EC-SFP1000-FE/GE',
//                                            '9' => 'SFP-1SM-1310nm-3SC',
//                                            '10' => 'SFP-1SM-1550nm-3SC'), 
//                                        array(
//                                            'empty'=>'Выбирете оборудование', 
//                                            'id'=>'models_form'
//            ));
        ?>
    </div>
        <div id="tasks"></div>
    
    <div class="row buttons" style="clear: left">
        <?php echo CHtml::submitButton('Создать'); ?>
    </div>
</div>
        
<?php Yii::app()->clientScript->registerCoreScript("jquery")?>
    <script>
        $(document).ready(function(){
            $("#models_form").change(function(){
                var model_id = $('#models_form option:selected').val();
                if(model_id){
                    $.get('FindAjax', {model_id: model_id}, function(data) {
                        $.fancybox({content:data});
                    });
                } else 
                    alert('Вы не выбрали ни одной модели оборудования');
            });
        });
    </script>

