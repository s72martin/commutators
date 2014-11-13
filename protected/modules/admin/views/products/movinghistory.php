<div style="float:left; margin-right: 100px; width: 50%;">
    <?php // print_r($_POST); ?>
    <h3>Знайти обладнання по серійному номеру:</h3>
    <?php echo CHtml::beginForm(); ?>
    <?php 
        $this->widget('CAutoComplete',
            array(
                'model'=>'m_products',
                'name'=>'prod_snum',
                'url'=>array('products/autocomplete'),
                'minChars'=>2,
            )
        );
    ?>
    <?php echo CHtml::submitButton('Знайти'); ?>
    <?php echo CHtml::endForm(); ?>
</div>

<hr>
<?php if($message): ?>
    <?php echo '<h2><em>'.$message.'</em></h2>'; ?>
<?php endif; ?>
<?php if($product): ?>
    <h2><em>За Вашим серійним номером знайдено наступне обладнання:</em></h2>
    <h4>    
        <?php echo $product->models->names->name_product; ?>
        <?php echo $product->models->model_name.'<br>'; ?>
        <?php echo 'серійний номер - '.$product->prod_snum; ?>
        <?php // echo $product->status->status_name; ?>

    </h4>
<?php endif; ?>    
    
<?php if($m_orders): ?>
    <h1 style="float:right"><?php echo $order->stockrooms->stockroom_name; ?></h1>
    <?php foreach ($m_orders as $order) :?>
    <h5>
        <hr>
        <?php echo $order->order_date; ?>
        <?php echo $order->status->status_name.': '; ?>
        <?php echo $order->streets->streetType->full_type.' '.$order->streets->street_name; ?>
        <?php echo $order->house_number.', '; ?>
        <p>Виконавець - 
            <?php echo $order->coworkers->coworker_name; ?>
            <?php echo '(накладна № '.Chtml::link($order->order_num, array('orders/check', 'order_num'=>$order->order_num)); ?>
            <?php echo 'від '.$order->order_date.')'; ?>
<h1><?php echo $order->stockrooms->stockroom_name; ?></h1>
        </p>
    </h5>
    <?php endforeach; ?>
<?php endif; ?>


