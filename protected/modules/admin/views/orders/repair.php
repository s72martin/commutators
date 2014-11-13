<?php if(Yii::app()->user->hasFlash('orders')): ?>
<div class="flash-success">
    <?php echo Yii::app()->user->getFlash('orders'); ?>
</div>
<?php endif; ?>
<div class="form">
    <?php echo CHtml::beginForm(); ?> 
    <div>
        <h1 style="float: left; margin: 0 20px 0 0;">Призначення операції:
            <?php 
                echo CHtml::activeDropDownList($m_orders, 'status_id', array(
                                            '3' => 'повернуто на склад (з ремонту)',
                                            '6' => 'здано в ремонт'), 
                                        array(
                                            'empty'=>'Вкажіть призначення', 
                                            'id'=>'selector')
                );
            ?>
        </h1>
    </div>
    <div style="clear: left; width:700px; height: 50px; margin: 0 auto">
        <h2 style="float: left; margin: 0 20px 0 0;">Накладна № 
            <?php $this->widget('CAutoComplete',
                    array(
                        'model'=>$m_orders,
                        'value'=>$m_orders->order_num,
                        'name'=>'order_num',
                        'url'=>array('orders/autocomplete'),
                        'minChars'=>2,
                    )
            ); ?>
            <?php // echo CHtml::activeTextField($m_orders, 'order_num', array('size'=>9)) ?>
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
        <h4><span class="on">Здав в ремонт:</span> <span class="off" style="display: none">Повернув із ремонту:</span>
            <?php echo CHtml::activeDropDownList($m_orders, 'coworker_id',
                CHtml::listData(Coworkers::model()->findAll(), 'coworker_id', 'coworker_name'));?>
        </h4>
    </div>
    <div>
        <h4 style="float: left; margin: 0 20px 0 0;" class="on">Адреса сервісного центру:
            <?php echo CHtml::activeDropDownList($m_orders, 'street_id', array('100' => 'Вітрука')); ?>
        </h4>
        <h4 style="float: left; margin: 0 20px 0 0; display: none;" class="off">Адреса складу:
            <?php echo CHtml::activeDropDownList($m_orders, 'street_id', array('434' => 'Московська'));?>
        </h4>
        <h4 class="on">будинок №:   
            <?php echo CHtml::activeTextField($m_orders, 'house_number', array('value'=>'17Б', 'size'=>2)) ?>
        </h4>
        <h4 class="off" style="display: none">будинок №:   
            <?php echo CHtml::activeTextField($m_orders, 'house_number', array('value'=>'15', 'size'=>2)) ?>
        </h4>
    </div>
    <div>
        <h4>Коментар:
            <?php echo CHtml::activeTextField($m_orders, 'order_comment', array('value'=>'сервісний цент ZyXEL ФОП Фещук Р.О.','size'=>50)); ?>            
        </h4>
    </div>
      
    <!-- =============================== Products ================================== -->
    <hr>
        <!--<button type="button" id="recovery">Выбрать оборудование</button>-->
    <div id="tasks"></div>
    <div class="row buttons" style="clear: left">
        <?php echo CHtml::submitButton('Создать'); ?>
    </div>

</div>
<script>
    $(document).ready(function(){
        $('#selector').change(function(){
            var status_id = $('#selector option:selected').val();
            if(status_id === '3'){
                $('.on').css('display','none');
                $('.off').css('display', 'inline');
            }
            if(status_id === '6'){
                $('.on').css('display','inline');
                $('.off').css('display', 'none');
            }
            $.get('RepairAjax', {status_id: status_id}, function(data){
                $.fancybox({content:data});
            }); 
        });

    });
</script>

    