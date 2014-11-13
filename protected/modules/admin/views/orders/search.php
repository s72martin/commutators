<div style="float: left; width: 50%; margin: 0 0 2% 0">
    <h2>Пошук по адресу:</h2>
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
<?php if($products) { ?>
    <?php if(is_array($products)) : ?>
        <h3>На даній адресі:<br> <span style="font-size: 24px; font-style: italic;">
        <?php echo $m_orders->streets->streetType->full_type.' '.$m_orders->streets->street_name; ?>, 
        <?php if($m_orders->house_number): ?> будинок № <?php echo $m_orders->house_number; ?> 
        <?php endif; ?><br></span>стоїть на обліку наступне обладнання:</h3>
        <table style="clear: left;" border="1">
            <thead>
                <tr>
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
                    <?php foreach($products as $key=>$ex_result):?>      
                    <tr>
                            <td><?php echo $ex_result->prod_id; ?></td>
                            <td><?php echo $ex_result->models->names->name_product; ?></td>
                            <td><?php echo $ex_result->models->model_name; ?></td>
                            <?php // echo CHtml::link($ex_result->prod_snum, array('orders/change', 'prod_id'=>$ex_result->prod_id)); ?>
                            <td><?php echo CHtml::link($ex_result->prod_snum, array('orders/remove', 'prod_id'=>$ex_result->prod_id)); ?></td>
                            <td><?php echo $ex_result->prod_quant; ?></td> 
                            <td><?php echo $ex_result->units->unit_name; ?></td>
                            <td><?php echo $ex_result->manufactures->manuf_name; ?></td>
                            <td><?php echo $ex_result->prod_comment; ?></td>
                    </tr>
                    <?php $street_kod = $ex_result->street_kod; ?>
                    <?php endforeach; ?>                
            </tbody>
        </table>
    <div class="row buttons" style="float:right; margin: 0 2% 2% 0;">
        <?php echo CHtml::link('Додати в накладну', array('orders/comeback', 'street_kod'=>$street_kod)); ?>
    </div>
    <?php endif; ?>
<?php } else if($m_orders->streets->street_name) { ?>        
        <?php echo '<h3 >На даній адресі: <span style="font-size: 24px; font-style: italic;"><br>';?>
        <?php echo $m_orders->streets->streetType->full_type.' '.$m_orders->streets->street_name; ?>, 
        <?php if($m_orders->house_number): ?> будинок № 
            <?php echo $m_orders->house_number; ?> 
        <?php endif; ?></span>
        <?php echo '<span style="color:blue;"> - на обліку нічого не значиться!</span></h3>'; ?>
<?php } ?>




