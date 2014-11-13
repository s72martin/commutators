<?php 
    if($index_i == 0) {
        $pointer = 1;
    } 
    else
        $pointer = $index_i;
?>

<tr class="_rows">
    <td>
        <?php echo CHtml::activeTextField($model, "[$index_i]order_item", array(size=>3, 'class'=>'orders')); ?>
    </td>
<script>
    $(document).ready(function(){
        $('.orders').each(function(i) {
            var number = i + 1;
            $(this).val(number+'.');
//            alert($(this).find('td:first').children().val());
//            
        });
    });
</script>