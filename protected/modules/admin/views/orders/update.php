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

	<?php echo $form->errorSummary(array($m_orders)); ?>
        
        <div style="float: left; margin: 0 0 20px 0">
            <h1 style="float: left; margin: 5px 10px 0 0;">
                <?php echo $form->labelEx($m_orders,'order_num'); ?>
            </h1>   
                <?php $this->widget('CAutoComplete',
            array(
                'model'=>$m_orders,
                'value'=>$m_orders->order_num,
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
        
        
<?php $this->endWidget(); ?>
</div><!-- form -->

<div id="tasks">
    <?php if($m_products): ?>
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
                <td id="purpose"><?php echo $item->prod_id ?></td>
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
    <?php endif; ?>
    </div>
