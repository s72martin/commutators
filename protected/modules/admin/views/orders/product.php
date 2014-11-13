   
    <td>
        <?php echo CHtml::activeTextField($m_products, "[$index_j]prod_snum", array()); ?>    
    </td>
    <td>
        <?php echo CHtml::activeTextField($m_products, "[$index_j]prod_quant", array(size=>7, value=>1)); ?>    
    </td>
    <td>
        <?php echo CHtml::activeTextField($m_products, "[$index_j]prod_comment", array(size=>50)); ?>    
    </td>
    <?php if($index_j != 0): ?>
    <td>
        <?php echo CHtml::button('      X      ', array('class'=>'tasks-del')); ?>
    </td>
    <?php endif; ?>
</tr>
<script>
    $(document).ready(function() {
        jQuery(".tasks-del").click(function(){
            var item = $(this).closest("._rows").find('.orders').val();
            $(this).closest("._rows").remove();
            $('.orders').each(function(item){
                var number = item + 1;
                $(this).val(number+'.');
             });
        }); 
    });
</script>