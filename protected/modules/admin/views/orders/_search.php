<?php
/* @var $this ProductsController */
/* @var $model Products */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($m_orders,'order_num'); ?>
		<?php echo $form->textField($m_orders,'order_num'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($m_orders,'order_date'); ?>
		<?php echo $form->textField($m_orders,'order_date'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($m_orders,'coworker_id'); ?>
		<?php echo CHtml::activeDropDownList($m_orders, 'coworker_id',
                        CHtml::listData(Coworkers::model()->findAll(), 'coworker_id', 'coworker_name')); ?>
	</div>

	<div class="row">
		<?php echo $form->label($m_orders,'street_id'); ?>
		<?php echo $form->textField($m_orders,'street_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($m_orders,'house_number'); ?>
		<?php echo $form->textField($m_orders,'house_number',array('size'=>32,'maxlength'=>32)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($m_orders,'street_kod'); ?>
		<?php echo $form->textField($m_orders,'street_kod',array('size'=>3,'maxlength'=>3)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($m_orders,'status_id'); ?>
		<?php echo $form->textField($m_orders,'status_id',array('size'=>32,'maxlength'=>32)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($m_orders,'stockroom_id'); ?>
		<?php echo $form->textField($m_orders,'stockroom_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($m_orders,'order_comment'); ?>
		<?php echo $form->textField($m_orders,'order_comment'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->