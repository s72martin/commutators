<div id="add">
    <?php foreach($m_orders as $item): ?>
        <h5><?php echo $item->order_date.' - '; ?> 
            <?php echo $item->status->status_name.':'; ?>
            <?php echo $item->streets->streetType->full_type.' '.$item->streets->street_name; ?>
            <?php echo $item->house_number.', '; ?>
            <p>Виконавець - 
            <?php echo $item->coworkers->coworker_name.' - '; ?>
            <?php // echo '(накладна № '.Chtml::link($item->order_num, array('orders/update', 'order_num'=>$item->order_num)); ?>
            <?php // echo 'від '.$item->order_date.')'; ?>
                <span style="color: red;"><?php echo $item->order_comment; ?></span>   
        </p>
    </h5>
    <?php endforeach; ?>
</div>