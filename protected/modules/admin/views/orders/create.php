<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'orders-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>
	<p class="note">Поля відмічені <span class="required">*</span> є обов'язковими.</p>

	<?php echo $form->errorSummary(array($m_orders, $m_products)); ?>
        
        <div style="float: left; margin: 0 0 20px 0">
            <h1 style="float: left; margin: 5px 10px 0 0;">
                <?php echo $form->labelEx($m_orders,'order_num'); ?>
            </h1>   
                <?php $this->widget('CAutoComplete',
            array(
                'model'=>'m_orders',
                'name'=>'order_num',
                'url'=>array('orders/autocomplete'),
                'minChars'=>2,
            )
        ); ?>
                <?php // echo $form->textField($m_orders,'order_num', array(
//                            'ajax'=>array(
//                                'type'=>'POST',
//                                'url'=>CController::createUrl('myTextField'),
//                                'replase'=>'#secondTextField'
//                            ), 
//                            'size'=>8
//                )); ?>
                <?php echo $form->error($m_orders,'order_num'); ?>
        </div>
        <div>
            <h2 style="float:left;margin: 5px 10px 0 10px">
                <?php echo $form->labelEx($m_orders,'order_date'); ?>
            </h2>
                <?php 
                    $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                        'name' => 'order_date',
                        'model' => $m_orders,
                        'attribute' => 'order_date',
                        'language' => 'ru',
                        'options' => array(
                            'showAnim' => 'fold',
                        ),
                        'htmlOptions' => array(
                            'style' => 'height:20px;'
                        ),
                    )); 
                ?> 
        </div>
        <div style="clear: both;">
            <h3 style="float:left;margin: 5px 10px 0 40px">
                <?php echo $form->labelEx($m_orders,'coworker_id'); ?>
            </h3>
                <?php echo $form->dropDownList($m_orders,'coworker_id', 
                    CHtml::listData(Coworkers::model()->findAll(), 'coworker_id', 'coworker_name')); ?>
                <?php echo $form->error($m_orders,'coworker_id'); ?>
        </div>
	<div style="float: left;">
            <h3 style="float:left;margin: 5px 10px 0 40px"> 
                <?php echo $form->labelEx($m_orders,'street_id'); ?>
            </h3>
                <?php echo $form->dropDownList($m_orders,'street_id',
                        CHtml::listData(Streets::model()->findAll(), 'street_id', 'street_name')); ?>
                <?php echo $form->error($m_orders,'street_id'); ?>
        </div>
        <div>
            <h3 style="float:left;margin: 5px 10px 0 10px">
                <?php echo $form->labelEx($m_orders,'house_number'); ?>
            </h3>    
                <?php echo $form->textField($m_orders,'house_number',array('size'=>5,'maxlength'=>56)); ?>
                <?php echo $form->error($m_orders,'house_number'); ?>
        </div>
        <div style="float: left;">
            <h3 style="float:left;margin: 5px 10px 0 40px"> 
                <?php echo $form->labelEx($m_orders,'street_kod'); ?>
            </h3>
                <?php echo $form->textField($m_orders,'street_kod'); ?>
                <?php echo $form->error($m_orders,'street_kod'); ?>
        </div>
        <div style="clear: both;">
            <h3 style="float:left;margin: 5px 10px 0 40px">
                <?php echo $form->labelEx($m_orders,'status_id'); ?>
            </h3>
                <?php echo $form->dropDownList($m_orders, 'status_id', array(
                    '1' => 'поступило на склад'
                )); ?>
                <?php // echo $form->dropDownList($m_orders,'status_id',
//                        CHtml::listData(Status::model()->findAll(), 'status_id', 'status_name')); ?>
                <?php echo $form->error($m_orders,'status_id'); ?>
        </div>
        <div>
            <h3 style="float:left;margin: 5px 10px 0 40px"><?php echo $form->labelEx($m_orders,'stockroom_id'); ?></h3>
            <?php echo $form->dropDownList($m_orders,'stockroom_id', 
                    CHtml::listData(Stockrooms::model()->findAll(), 'stockroom_id', 'stockroom_name')); ?>
            <?php echo $form->error($m_orders,'stockroom_id'); ?></h3>
        </div>
	<div class="row">
            <h3 style="float:left;margin: 5px 10px 0 40px"><?php echo $form->labelEx($m_orders,'order_comment'); ?></h3>
            <?php echo $form->textField($m_orders,'order_comment',array('size'=>50,'maxlength'=>256)); ?>
            <?php echo $form->error($m_orders,'order_comment'); ?>
	</div>
<!-- ========================= Products ============================== -->
    <hr>
        <div style="width:21%; float: left;margin: 5px 5px 15px 5px">
            <h3 style="float:left;margin: 5px 10px 0 5px"><?php echo $form->labelEx($m_products,'type_id'); ?></h3>
            <?php echo $form->dropDownList($m_products,'type_id', 
                    CHtml::listData(Types::model()->findAll(), 'type_id', 'type_name')); ?>
            <?php echo $form->error($m_products,'type_id'); ?></h3>
        </div>
        <div style="width:25%; float: left; margin: 5px 5px 15px 5px">
            <h3 style="float:left;margin: 5px 10px 0 5px"><?php echo $form->labelEx($m_products,'model_id'); ?></h3>
            <?php echo $form->dropDownList($m_products,'model_id',
                    CHtml::listData(Models::model()->with('names')->findAll(),
                            'model_id', 'model_name', 'names.name_product')); ?>
            <?php echo $form->error($m_products,'model_id'); ?></h3>
        </div>
        <div style="width:15%; float: left; margin: 5px 5px 15px 5px">
            <h3 style="float:left;margin: 5px 10px 0 5px"><?php echo $form->labelEx($m_products,'manuf_id'); ?></h3>
            <?php echo $form->dropDownList($m_products,'manuf_id', 
                    CHtml::listData(Manufactures::model()->findAll(), 'manuf_id', 'manuf_name')); ?>
            <?php echo $form->error($m_products,'manuf_id'); ?></h3>
        </div>
        <div style="width:15%; float: left; margin: 5px 5px 15px 5px">
            <h3 style="float:left;margin: 5px 10px 0 5px"><?php echo $form->labelEx($m_products,'unit_id'); ?></h3>
            <?php echo $form->dropDownList($m_products,'unit_id', 
                    CHtml::listData(Units::model()->findAll(), 'unit_id', 'unit_name')); ?>
            <?php echo $form->error($m_products,'unit_id'); ?></h3>
        </div>
        
<div class="form">
   <?php echo CHtml::beginForm()?>

    <table class="tasks" style="clear: left;" class="create">
        <thead>
            <tr>
                <th>№ пп</th>
                <th>Серійний номер</th>
                <th>Кількість</th>
                <th>Коментарі</th>
                <th>Видалити</th>
            </tr>
        </thead>
        <tbody>
            <?php for($i=0; $i<count($models); $i++):?>
            <?php $this->renderPartial('_task', array(
                'model' => $models[$i],
                'index_i' => $i )) ?>
            <?php endfor ?>
            <?php for($j=0; $j<count($ms_products); $j++):?>
            <?php $this->renderPartial('product', array(
                'm_products'=> $ms_products[$j],
                'index_j' => $j )) ?>    
            <?php endfor ?>
        </tbody>
    </table>
    
    <div class="row buttons">
        <?php echo CHtml::button('Добавить строку', array('class' => 'tasks-add')) ?>
        <?php Yii::app()->clientScript->registerCoreScript("jquery")?>
        <script>
            $(document).ready(function() {
                jQuery(".tasks-add").click(function(){
                    jQuery.ajax({
                        success: function(html) {
                            jQuery(".tasks").append(html);
                        },
                        type: 'get',
                        url: '<?php echo $this->createUrl("field");?>',
                        data: { 
                            index_i: jQuery(".tasks tr").size(),
                            index_j: jQuery(".tasks tr").size()
                        },
                        cache: false,
                        dataType: 'html'
                    });
                });
            });
        </script>
        <?php // echo CHtml::submitButton('Записать') ?>
    </div>
    <div class="row buttons">
        <?php echo CHtml::submitButton($m_orders->isNewRecord ? 'Создать' : 'Сохранить', array('class'=>'_create')); ?>
    </div> 
    <?php echo CHtml::endForm() ?>
       
<?php $this->endWidget(); ?>
</div><!-- form -->
</div>
