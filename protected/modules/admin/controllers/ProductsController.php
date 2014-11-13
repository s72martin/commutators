<?php

class ProductsController extends Controller {
        public function actionIndex() {
            echo'Это контроллер Products, action - index';
        }

        public function actionStore() {
            $m_products = Products::model()->findAllByAttributes(array('status_id'=>1), array('order'=>'model_id ASC'));

            $this->render('store', array('m_products'=>$m_products));
	}
        
        public function actionRemove() {
            $m_products = Products::model()->findAllByAttributes(array('status_id'=>3), array('order'=>'prod_snum ASC'));

            $this->render('store', array('m_products'=>$m_products));            
        }
        
        public function actionRepair() {
            $m_products = Products::model()->findAllByAttributes(array('status_id'=>6), array('order'=>'prod_snum ASC'));
            
            $this->render('repair', array('m_products'=>$m_products));
        }

        public function actionInformremove($prod_id) {
            $m_orderItem = OrderItem::model()->findAllByAttributes(array('prod_id'=>$prod_id));
            foreach ($m_orderItem as $item) {
                $array_item[] = $item->order_num;
            }
            $m_orders = Orders::model()->findAllByAttributes(array('order_num'=>$array_item), array('order'=>'order_date ASC'));
            
            $prod_id = $this->renderPartial('store_add', array('m_orders'=>$m_orders), true );
            echo $prod_id;
            Yii::app()->end();
            return;
        }
        public function actionExchange($prod_id) {
            $m_orders = new Orders();
            $m_product = Products::model()->findAllByAttributes(array('prod_id'=>$prod_id));
            $m_products = new Products();
            if(isset($_POST['Products'])) {
                $m_products->attributes = $_POST['Products'];
                if($m_products->save()){
                    $result = Products::model()->findBySql('SELECT MAX(prod_id) AS prod_id FROM Products');
//                    $this->redirect('repair', array('m_products'=>$m_products));  
                }
                $sql = "UPDATE Products SET exchange_id = $result->prod_id, status_id = 7 WHERE prod_id = $prod_id";
                $this->Insert_DB($sql);
            }
            $this->render('exchange', array('m_orders'=>$m_orders, 'm_products'=>$m_products, 'm_product'=>$m_product));
        }
        
        public function actionWarranty() {
            $m_products = Products::model()->findAllBySql('SELECT prod_id, exchange_id, type_id, model_id, '
                    .'prod_snum, prod_quant, unit_id, manuf_id, status_id, prod_comment FROM Products WHERE exchange_id > 0');
            $this->render('warranty', array('m_products'=>$m_products));
        }

        public function actionTechnicalsupport() {
            $m_products = Products::model()->findAllByAttributes(array('status_id'=>5), array('order'=>'model_id ASC'));
            
            $this->render('technicalsupport', array('m_products'=>$m_products));
        }

        public function actionMovinghistory() {
            $m_products = new Products();
            $m_orderItem = new OrderItem();
            foreach ($_POST as $key=>$item) {
                    if($key == prod_snum) {
                       $m_products->prod_snum = $item;
                    }
            }
            if($m_products->prod_snum){
              $product = Products::model()->findByAttributes(array('prod_snum'=>$m_products->prod_snum));
              if($product === null) {
                  $message = "Вибачте, але на жаль в базі відсутнє обладнання з серійним номером - $m_products->prod_snum";
                  $this->render('movinghistory', array('m_products'=>$m_products, 'message'=>$message));
//                throw new CHttpException(404, "Вибачте, але на жаль в базі відсутнє обладнання з серійним номером - $m_products->prod_snum");
              } else {
              $m_orderItem = OrderItem::model()->findAll('prod_id=:prod_id', array(':prod_id'=>$product->prod_id));
                foreach ($m_orderItem as $key=>$order_num) {
                    if(!empty($string))
                        $string = $string.', "'.$order_num->order_num.'"';
                    else 
                        $string = '"'.$order_num->order_num.'"';
                }
                $m_orders = Orders::model()->findAllBySql('SELECT order_num, order_date, coworker_id, street_id, house_number, status_id, stockroom_id, order_comment FROM Orders WHERE order_num IN('.$string.') ORDER BY order_date');
                $this->render('movinghistory', array('m_products'=>$m_products, 'product'=>$product, 'm_orders'=>$m_orders));
              }
           } else {
               $this->render('movinghistory', array('m_products'=>$m_products));
           }    
        }
        
        public function actionAutoComplete() {
            if(isset($_GET['q'])) {
                $criteria = new CDbCriteria;
                $criteria->condition = 'prod_snum LIKE :products';
                $criteria->params = array(':products'=>'%'.$_GET['q']);
                
                if(isset($_GET['limit']) && is_numeric($_GET['limit'])) {
                    $criteria->limit = $_GET['limit'];
                }
                
                $products = Products::model()->findAll($criteria);
                $resStr = '';
                foreach ($products as $product) {
                    $resStr .= $product->prod_snum."\n";
                }
                echo $resStr;
            }
        }

        public function Insert_DB($sql) {
            $connection = Yii::app()->db;
            $command = $connection->createCommand($sql);
            $list = $command->execute();
            return $list;
        }
}