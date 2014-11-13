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
<table style="clear: left;" border="1" class="report">
    <thead>
        <tr>
            <th>№№</th>
            <th style="padding: 5px 0;">Дата</th>
            <th>Назва вулиці</th>
            <th>Буд.№</th>
            <th>PROD_ID </th>
            <th>Назва комутатора</th>
            <th>Серійний номер</th>
            <th>Кіл-ть</th>
            <th>Од. вим.</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($products as $ex_result):?>
            <?php foreach($ex_result as $key=>$item):?>
                <?php if($key == status_id AND $status_id != $item): ?>
                <?php echo '<tr><td colspan="9" id="headline">'; ?>
                        <?php switch ($item) {
                                    case(1):
                                        $count = 0;
                                        $status_id = $item;
                                        echo 'Поступило на склад';
                                        break;
                                    case(2):
                                        $count = 0;
                                        $status_id = $item;
                                        echo 'Вставлено на адресу';
                                        break;
                                    case(3):
                                        $count = 0;
                                        $status_id = $item;
                                        echo 'Знято з адреси (повернуто на склад)';
                                        break;
                                    case(4):
                                        $count = 0;
                                        $status_id = $item;
                                        echo 'Переміщено на іншу адресу';
                                        break;
                                    case(5):
                                        $count = 0;
                                        $status_id = $item;
                                        echo 'Видано технічній підтримці';
                                        break;
                                    case(6):
                                        $count = 0;
                                        $status_id = $item;
                                        echo 'Здано в ремонт';
                                        break;
                                    case(7):
                                        $count = 0;
                                        $status_id = $item;
                                        echo 'Замінено по гарантії';
                                        break;
                                    case(8):
                                        $count = 0;
                                        $status_id = $item;
                                        echo 'Списано з обліку по акту';
                                        break;
                                    default:
                                        $count = 0;
                                        echo 'За звітний період жодних переміщень обладнання не було';
                                        break;
                              }
                        ?>
                   <?php echo '</td></tr><tr>'; ?>
                <?php endif; ?>
            <?php   if($key == status_id){
                        $count = $count+1;
                        echo '<td>'.$count.'.</td>';
//                        echo '<td style="visibility:collapse">'.$item.'</td>';
                    }else if($key == order_date) {
                      echo '<td>'.date("d.m.Y", $item).'</td>';
                    }else{
                        if($key == unit_name) { 
                            echo '<td style="border-right: 1px solid gray;">'.$item.'</td>'; 
                        } else {
                            echo '<td>'.$item.'</td>'; 
                        }
                    } ?>
            <?php endforeach; ?>
        <?php echo '</tr>'; ?>
        <?php endforeach; ?>  
    </tbody>
</table>
<?php endif; ?>