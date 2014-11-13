<div style="float: left; width: 50%; margin: 0 0 2% 0">
    <h2>Повернення обладнання на скад:</h2>
    <?php echo CHtml::beginForm(); ?>
    <?php echo CHtml::activeDropDownList($m_orders, 'street_id', 
                CHtml::listData(Streets::model()->findAll(), 'street_id', 'street_name'),
                        array('empty'=>'Вкажіть адресу')
            ); ?>
    <?php echo CHtml::activeTextField($m_orders, 'house_number', array('size'=>3)); ?>
    <?php echo CHtml::submitButton('Знайти'); ?>
    <?php echo CHtml::endForm(); ?>
</div>
<hr>
<?php if($products): ?>


<?php endif; ?>
