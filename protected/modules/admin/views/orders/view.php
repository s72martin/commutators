<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$m_orders,
	'attributes'=>array(
            'order_num',
            'order_date',
            array(
                'name'=>'coworker_id',
                'value'=>$m_orders->coworkers->coworker_name
            ),
            array(
                'name'=>'street_id',
                'value'=>$m_orders->streets->streetType->short_type.' '.$m_orders->streets->street_name   
            ),
            'house_number',
            'street_kod',
            array(
                'name'=>'status_id',
                'value'=>$m_orders->status->status_name
            ),
            array(
                'name'=>'stockroom_id',
                'value'=>$m_orders->stockrooms->stockroom_name
            ),
            'order_comment'
        ),
));