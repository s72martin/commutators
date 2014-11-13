<div class="form">
    <?php echo CHtml::beginForm(); ?> 
    <table class="tasks"style="float:left;">
        <thead> 
            <tr>
                <th>Вийшло з ладу </th>
                <th></th>
                <th>Підлягає заміні по гарантії</th>
            </tr>
        </thead>
        <tbody>
            <tr>
        <?php foreach ($m_product as $item): ?>
                <td>Внесіть ID </td>
                <td><?php echo '------------> '.$item->prod_id; ?></td> 
                <td><?php echo CHtml::activeTextField($m_products, 'exchange_id', array('size'=>3)); ?></td>
            </tr>
            <tr>
                <td><?php echo $item->types->type_name; ?></td>
                <td></td>
                <td><?php echo CHtml::activeDropDownList($m_products,'type_id', 
                        CHtml::listData(Types::model()->findAll(), 'type_id', 'type_name')); ?></td>
            </tr>
            <tr>
                <td><?php echo $item->models->names->name_product.' / '.$item->models->model_name; ?></td>
                <td></td>
                <td><?php echo CHtml::activeDropDownList($m_products,'model_id',
                    CHtml::listData(Models::model()->with('names')->findAll(),
                            'model_id', 'model_name', 'names.name_product')); ?></td>
            </tr>
            <tr>
                <td><?php echo $item->prod_snum;?></td>
                <td></td>
                <td><?php echo CHtml::activeTextField($m_products, 'prod_snum'); ?></td>
            </tr>
            <tr>
                <td>Виробник</td>
                <td></td>
                <td><?php echo CHtml::activeDropDownList($m_products,'manuf_id', 
                    CHtml::listData(Manufactures::model()->findAll(), 'manuf_id', 'manuf_name'));?></td>
            </tr>
            <tr>
                <td>Кількість</td>
                <td></td>
                <td><?php echo CHtml::activeTextField($m_products, 'prod_quant', array('size'=>3)); ?></td>
            </tr>
            <tr>
                <td>Одиниці виміру</td>
                <td></td>
                <td><?php echo CHtml::activeDropDownList($m_products,'unit_id',     
                    CHtml::listData(Units::model()->findAll(), 'unit_id', 'unit_name')); ?></td>
            </tr>

            <td><?php echo $item->prod_comment; ?></td>
        <?php endforeach; ?>
            </tr>
        </tbody>
    </table>


    <div class="row buttons" style="clear: left">
        <?php echo CHtml::submitButton('Замінити'); ?>
    </div>
    <?php echo CHtml::endForm(); ?>
</div><!--.form-->

