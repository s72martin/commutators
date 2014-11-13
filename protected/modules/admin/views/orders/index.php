<?php 
Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#products-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>
<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'm_orders'=>$m_orders,
)); ?>
</div><!-- search-form -->
<?php 
    $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'products-grid',
	'dataProvider'=>$m_orders->search(),
	'filter'=>$m_orders,
	'columns'=>array(
            'order_num',
            'order_date',
            array(
                'name'=>'coworker_id', 
                'value'=>'$data->coworkers->coworker_name',
            ),
            array(
                'name'=>'street_id',
                'value'=>'$data->streets->streetType->short_type." ".$data->streets->street_name'
            ),
            'house_number',
            array(
                'name'=>'status_id',
                'value'=>'$data->status->status_name'
            ),
            array(
			'class'=>'CButtonColumn',
            ),
            
         ),
            
      ));