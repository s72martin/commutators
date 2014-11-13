<?php

class OrderItemController extends Controller
{
        public function filters() {
        return array('ajaxOnly + field');
    }
	public function actionIndex() {
            
//            $m_orders = Orders::model()->findAll();
//            $m_orderItem = new OrderItem();
//            $connection = Yii::app()->db;
//            $sql ='SELECT * FROM Orders';
//            $command = $connection->createCommand($sql);
//            $m_orders = $command->queryAll();
            $models = array();
            if(!empty($_POST['OrderItem'])) {
                foreach ($_POST['OrderItem'] as $taskData) {
                    $m_orderItem = new OrderItem();
                    $m_orderItem->setAttributes($taskData);
                    if($model->validate())
                        $models[] = $m_orderItem;
                }
            }
            if(!empty($models)) {
                
            }
            else 
                $models[] = new OrderItem();
            
            $this->render('index', array('models'=>$models));
        }
        
        

}