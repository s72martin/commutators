<div class="form">
    <?php echo CHtml::beginForm(); ?> 
    <div><h2>Введіть діапазон дат, за який потрібно сформувати звіт!</h2></div>
    <div style="float:left; width:300px; height: 50px; margin: 10px auto;">
        <h3>початкова дата
            <?php 
                $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                            'name' => 'order_date_start',
                            'value' => $order_date_start,
                            'attribute' => 'order_date_start',
                            'language' => 'ru',
                            'options' => array(
                                    'showAnim' => 'fold',
                            ),
                            'htmlOptions' => array(
                                    'size' => 23,
                                    'style' => 'height:20px;'
                            ),
                )); 
            ?>
        </h3>
    </div>

    <div style="float: left; width:300px; height: 50px; margin: 10px auto;">
        <h3>кінцева дата
            <?php 
                $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                            'name' => 'order_date_end',
                            'model' => $m_orders,
                            'attribute' => 'order_date',
                            'language' => 'ru',
                            'options' => array(
                                    'showAnim' => 'fold',
                            ),
                            'htmlOptions' => array(
                                    'size' => 23,
                                    'style' => 'height:20px;'
                            ),
                )); 
            ?>
        </h3>
    </div>
    
    <div class="row buttons" style="clear: left">
        <?php echo CHtml::submitButton('Ввести'); ?>
    </div>
    <?php echo CHtml::endForm(); ?>
</div>
<hr>
<?php if(isset($products)): ?>
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
        <tr>
            <td colspan="8" style="font-size: 18px; font-weight:  bold;">
                Поставлено на адресу
            </td>
        </tr>
    <?php foreach($products as $key=>$ex_result):?>   
        <?php if($ex_result->status_id == 2): ?>
            <?php $this->renderPartial('report_partial', array('ex_result'=>$ex_result)); ?>
        <?php endif; ?>
    <?php endforeach; ?>    
        <tr>
            <td colspan="8"><hr></td>
        </tr>
    </tbody>
    <tbody>
        <tr>
            <td colspan="8" style="font-size: 18px; font-weight:  bold;">Знято з адреси (повернуто на склад)</td>
        </tr>
    <?php foreach($products as $key=>$ex_result):?>     
        <?php if($ex_result->status_id == 3): ?>
            <?php $this->renderPartial('report_partial', array('ex_result'=>$ex_result)); ?>
        <?php endif; ?>
    <?php endforeach; ?>   
        <tr>
            <td colspan="8"><hr></td>
        </tr>
    </tbody>
    <tbody>
        <tr>
            <td colspan="8" style="font-size: 18px; font-weight:  bold;">Переміщено на іншу адресу</td>
        </tr>
    <?php foreach($products as $key=>$ex_result):?>   
        <?php if($ex_result->status_id == 4): ?>
            <?php $this->renderPartial('report_partial', array('ex_result'=>$ex_result)); ?>
        <?php endif; ?>
    <?php endforeach; ?>   
        <tr>
            <td colspan="8"><hr></td>
        </tr>
    </tbody>
    <tbody>
        <tr>
            <td colspan="8" style="font-size: 18px; font-weight:  bold;">Видано технічній підтримці</td>
        </tr>
    <?php foreach($products as $key=>$ex_result):?>   
        <?php if($ex_result->status_id == 5): ?>
            <?php $this->renderPartial('report_partial', array('ex_result'=>$ex_result)); ?>
        <?php endif; ?>
    <?php endforeach; ?>   
        <tr>
            <td colspan="8"><hr></td>
        </tr>
    </tbody>
    <tbody>
        <tr>
            <td colspan="8" style="font-size: 18px; font-weight:  bold;">Здано в ремонт</td>
        </tr>
    <?php foreach($products as $key=>$ex_result):?>   
        <?php if($ex_result->status_id == 6): ?>
            <?php $this->renderPartial('report_partial', array('ex_result'=>$ex_result)); ?>
        <?php endif; ?>
    <?php endforeach; ?>   
        <tr>
            <td colspan="8"><hr></td>
        </tr>
    </tbody>
    <tbody>
        <tr>
            <td colspan="8" style="font-size: 18px; font-weight:  bold;">Замінено по гарантії</td>
        </tr>
    <?php foreach($products as $key=>$ex_result):?>   
        <?php if($ex_result->status_id == 7): ?>
            <?php $this->renderPartial('report_partial', array('ex_result'=>$ex_result)); ?>
        <?php endif; ?>
    <?php endforeach; ?>   
        <tr>
            <td colspan="8"><hr></td>
        </tr>
    </tbody>
    <tbody>
        <tr>
            <td colspan="8" style="font-size: 18px; font-weight:  bold;">Списано з обліку по акту</td>
        </tr>
    <?php foreach($products as $key=>$ex_result):?>   
        <?php if($ex_result->status_id == 8): ?>
            <?php $this->renderPartial('report_partial', array('ex_result'=>$ex_result)); ?>
        <?php endif; ?>
    <?php endforeach; ?>   
        <tr>
            <td colspan="8"><hr></td>
        </tr>
    </tbody>
</table>
<?php endif; ?>