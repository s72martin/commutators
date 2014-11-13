<?php

class OrdersController extends Controller {
    
    public function filters() {
        return array(
            'ajaxOnly + field'
        );
    }
    public function actionIndex() {
                    $m_orders = new Orders('search');
		$m_orders->unsetAttributes();  // clear any default values
		if(isset($_GET['Orders']))
			$m_orders->attributes=$_GET['Orders'];
		$this->render('index',array(
			'm_orders'=>$m_orders,
		));
	}
        
    public function actionUpdate($id) {
        $m_orders = $this->loadModel($id);
        $m_orderItem = OrderItem::arrayOrderItem($m_orders->order_num);
        $array_prod_id = OrderItem::orderItemArray($m_orderItem);
        $m_products = Products::arrayProducts($array_prod_id);    
        if(isset($_POST['Orders'])) {
            $m_orders->attributes = $_POST["Orders"];
            if($m_orders->save())
                $this->redirect(array('view', 'order_num'=>$m_orders->order_num));
        }
        $this->render('update', array('m_orders'=>$m_orders, 'm_products'=>$m_products));
    }
    
    public function actionExtradition() {
        $m_orders = new Orders();
        if(isset($_POST['Orders'])) {
            $m_orders->attributes = $_POST['Orders'];
            $valid = $m_orders->validate();
            if($valid) {
                $orders_num = $m_orders->order_num;
                $status_id = $m_orders->status_id;
                $street_id = $m_orders->street_id;
                $house_number = $m_orders->house_number;
                $this->streetKod($street_id, $house_number, $m_orders);
                $m_orders->save(false);
                if(isset($_POST['array_prod_id'])) {
                    $array_prod_id = explode(",", $_POST['array_prod_id']);
                    foreach ($array_prod_id as $key=>$value) {
                        $key = $key+1;
                        $m_orderItem = new OrderItem();
                        $m_orderItem->order_num = $orders_num;
                        $m_orderItem->order_item = $key;
                        $m_orderItem->prod_id = $value;
                        $m_orderItem->save(false);
                        $m_product = Products::model()->findByPk($value);
                        $m_product->status_id = $status_id;
                        $m_product->save(false);
                    } 
                }
                Yii::app()->user->setFlash('orders', 'Данні занесено в БД та збережені успішно');
            }
        }   
        $this->render('extradition', array('m_orders' => $m_orders, 'm_products'=>$m_products));
    }   
    public function actionCreate() {
        $models = array();
        $ms_products = array();
        $m_orders = new Orders();
        $m_orderItem = new OrderItem();
        $m_products = new Products();
        $array_products = array();
//принимаем данные и записываем в модель Orders
        if(isset($_POST['Orders'])) {
            foreach ($_POST as $key=>$item) {
                    if($key == order_num) {
                       $m_orders->order_num = $item;
                    }
            }
            $m_orders->attributes = $_POST['Orders'];
            $street_id = $m_orders->street_id;
            $house_number = $m_orders->house_number;
            $this->streetKod($street_id, $house_number, $m_orders); 
//            $street_kod = $m_orders->street_kod;
                //сохраняем наши данные без валидации, так как валидация уже была произведена
                if($m_orders->save(false)) {
                    $order_num = '"'.$m_orderItem->order_num = $m_orders->order_num.'"';
                }
        }
        if(isset($_POST['Products'])) {
            $m_products->attributes = $_POST['Products'];
        }
        if(!empty($_POST['Products'])) {
            foreach ($_POST['Products'] as $product) {
                $m_products->setAttributes($product);
                if($m_products->validate())
                    $ms_products[] = $m_products;
            } 
        }
        if(!empty($ms_products)) {
            foreach ($_POST['Products'] as $product) {
                if(is_array($product)){
                    foreach ($product as $key=>$value) {
                        if(!empty($s_key)){
                            $s_key = $s_key.', '.$key; 
                            $s_value = $s_value.', "'.$value.'"';
                        } else {
                            $s_key = $s_key.$key;                        
                            $s_value = $s_value.'"'.$value.'"';
                        }
                    }
                    $sql = "INSERT INTO Products (type_id, model_id, manuf_id, unit_id, status_id, street_kod, $s_key) "
                            . "VALUES($m_products->type_id, $m_products->model_id, $m_products->manuf_id, $m_products->unit_id, $m_orders->status_id, $m_orders->street_kod, $s_value)"; 
                    $this->Insert_DB($sql);
                    $s_key = $s_value = NULL;
                    $result = Products::model()->findBySql('SELECT MAX(prod_id) AS prod_id FROM Products');
                    $array_products[] = $result->prod_id;
                }
            }
        }
        else {
            $ms_products[] = new Products();
        }
        if(!empty($_POST['OrderItem'])) {
            foreach ($_POST['OrderItem'] as $taskData) {
                $m_orderItem->setAttributes($taskData);
                $m_orderItem->order_item = (int)($m_orderItem->order_item);
                if($m_orderItem->validate())
                    $models[] = $m_orderItem;
            }
        }
        if(!empty($models)) {
            foreach ($_POST['OrderItem'] as $values) {
                foreach ($values as $key=>$value) {
                    if(!empty($s_key)){
                        $s_key = $s_key.', "'.$key.'"'; 
                        $s_value = $s_value.', '.$value;
                    } else {
                        $s_key = $s_key.$key;                        
                        $s_value = $s_value.'"'.$value.'"';
                    }
                    $count = $value-1;
                }
                $sql = "INSERT INTO OrderItem(order_num, $s_key, prod_id) VALUES($order_num, $s_value, $array_products[$count])"; 
                $this->Insert_DB($sql);
                $s_key = $s_value = NULL;
            }
        }
        else {
            $models[] = new OrderItem();
        }
            $this->render('create', array(
                    'models'=>$models,
                    'm_orders'=>$m_orders,
                    'm_products' => $m_products,
                    'ms_products'=>$ms_products
            ));
        }
    public function actionCheck($order_num) {
        $m_orders = $this->loadModel($order_num);
        $m_orderItem = OrderItem::arrayOrderItem($m_orders->order_num);
        $array_prod_id = OrderItem::orderItemArray($m_orderItem);
        $m_products = Products::arrayProducts($array_prod_id);
        if(isset($_POST['Orders'])) {
            $m_orders->attributes = $_POST['Orders'];
            $street_id = $m_orders->street_id;
            $house_number = $m_orders->house_number;
            $this->streetKod($street_id, $house_number, $m_orders); 
            $street_kod = $m_orders->street_kod;
            foreach ($m_products as $item) {              
                $item->street_kod = $street_kod;
                $item->save();
            }
            if($m_orders->save()) {
                $this->redirect(array('check', 'order_num'=>$m_orders->order_num));
            }
        }
        $this->render('check', array('m_orders'=>$m_orders, 'm_products'=>$m_products));
    }
    public function actionSearch() {
        $m_orders = new Orders();
        $m_orders->attributes = $_POST['Orders']; 
        
        if(isset($_POST['Orders'])) {
            if(isset($m_orders->house_number)) {
                $m_order = Orders::model()->findAllByAttributes(array(
                    'street_id'=>$m_orders->street_id, 
                    'house_number'=>$m_orders->house_number,
//                    'status_id'=>array(2, 4)
                ));
            } else {
                $m_order = Orders::model()->findAllByAttributes(array(
                    'street_id'=>$m_orders->street_id, 
                    'status_id'=>array(2, 4)
                ));
            }
            $m_orderItem = OrderItem::model()->findAllByAttributes(array('order_num'=>$this->orders_num_array($m_order)));
            $products = Products::model()->findAllByAttributes(array(
                            'prod_id'=>$this->itemArray($m_orderItem),
                            'street_kod'=>$this->street_kod_array($m_order),
                            'status_id'=>array(2,4)));
        }
        $this->render('search', array('m_orders'=>$m_orders, 'products'=>$products));
    }
    public function actionChange($prod_id) {
        $m_orders = new Orders();
        $m_products = Products::model()->findAllByAttributes(array('prod_id'=>$prod_id));
        $prod_id = $prod_id;
        if(isset($_POST['Orders'])) {
            $m_orders->attributes = $_POST['Orders'];  
            $status_id = $m_orders->status_id;
            $street_id = $m_orders->street_id;
            $house_number = $m_orders->house_number;
            $this->streetKod($street_id, $house_number, $m_orders);
            $street_kod = $m_orders->street_kod;
            $valid = $m_orders->validate();
            if($valid) {                        
                $m_orders->save(false);
                $m_orderItem = new OrderItem();
                $m_orderItem->order_num = $m_orders->order_num;
                $m_orderItem->order_item = '1';
                $m_orderItem->prod_id = $prod_id;
                $m_orderItem->save(false);
                $m_products = Products::model()->findByPk($prod_id);
                if($m_products === null)
                    throw new CHttpException(404, 'Сторінку яку ви запитували, не існує');
                $m_products->status_id = $status_id;
                $m_products->street_kod = $street_kod;
                $m_products->save(false);     
                Yii::app()->user->setFlash('orders', 'Данні занесено в БД та збережені успішно');
            }
        }
        $this->render('change', array('m_orders'=>$m_orders, 'm_products'=>$m_products));
    }
    public function actionRemove($prod_id) {
        $m_orders = new Orders();
        $m_orderItem = new OrderItem();
        $m_products = Products::model()->findAllByAttributes(array('prod_id'=>$prod_id));
        if(isset($_POST['Orders'])) {
            $m_orders->attributes = $_POST['Orders'];
                $m_orderItem->order_num = $m_orders->order_num;
                $status_id = $m_orders->status_id;
                $street_id = $m_orders->street_id;
                $house_number = $m_orders->house_number;
                $this->streetKod($street_id, $house_number, $m_orders);
                $street_kod = $m_orders->street_kod;
                $m_orders->save();
            $m_orderItem->order_item = "1";
            $m_orderItem->prod_id = $prod_id;
            $m_orderItem->save();
            foreach ($m_products as $item) {
                $item->status_id = $status_id;
                $item->street_kod = $street_kod;
                $item->save();
            }                
        }
        $this->render('remove', array('m_orders'=>$m_orders, 'm_products'=>$m_products));
    }
    
    public function actionRepair() {
        $m_orders = new Orders();
        $m_orderItem = new OrderItem();
        if(isset($_POST['Orders'])) {
            $m_orders->attributes = $_POST['Orders'];
            $order_num = $m_orders->order_num;
            $status_id = $m_orders->status_id;
//            $street_id = $m_orders->street_id;
//            $house_number = $m_orders->house_number;
            $this->streetKod($m_orders->street_id, $m_orders->house_number, $m_orders);
            $street_kod = $m_orders->street_kod;
            $m_orders->save();
            if(isset($_POST['array_prod_id'])) {
                    $array_prod_id = explode(",", $_POST['array_prod_id']);
                    foreach ($array_prod_id as $key=>$value) {
                        $key = $key+1;
                        $m_orderItem = new OrderItem();
                        $m_orderItem->order_num = $order_num;
                        $m_orderItem->order_item = $key;
                        $m_orderItem->prod_id = $value;
                        $m_orderItem->save(false);
                        $m_product = Products::model()->findByPk($value);
                        $m_product->status_id = $status_id;
                        $m_product->street_kod = $street_kod;
                        $m_product->save(false);
                    } 
            }
            Yii::app()->user->setFlash('orders', 'Данні занесено в БД та збережені успішно');
        }
        
        $this->render('repair', array('m_orders'=>$m_orders));
    }

    public function actionReport() {
        $m_orders = new Orders();
        if(isset($_POST['Orders'])) {
            $order_date_start = $_POST['order_date_start'];
            $date_start = date(strtotime($order_date_start));
            $m_orders->attributes = $_POST['Orders'];
            $date_end = date(strtotime($m_orders->order_date));
            $sql = "SELECT Orders.status_id, order_date, Streets.street_name, house_number, Products.prod_id, Models.model_name, prod_snum, prod_quant, Units.unit_name FROM Orders, OrderItem, Products, Streets, Models, Units 
                                                                       WHERE Products.unit_id = Units.unit_id 
                                                                        AND Products.model_id = Models.model_id
                                                                        AND OrderItem.prod_id = Products.prod_id
                                                                        AND Streets.street_id = Orders.street_id
                                                                        AND Orders.order_num = OrderItem.order_num
                                                                        AND order_date BETWEEN $date_start AND $date_end ORDER BY Orders.status_id, Products.model_id";

            $this->render('report_1', array('m_orders'=>$m_orders, 'order_date_start'=> $order_date_start, 'products'=>$this->Select_DB($sql)));
        } else {
            $this->render('report_1', array('m_orders'=>$m_orders));
        }
    }
    public function actionField($index_i, $index_j) {
        $m_orderItem = new OrderItem();
        $ms_products = new Products();
        $this->renderPartial('_task', array(
            'model' => $m_orderItem,
            'index_i' => $index_i,
        ));
        $this->renderPartial('product', array(
            'm_products' => $ms_products,
            'index_j' => $index_j
        ));
    }
    public function actionFindAjax() {
        $result = Products::model()->findAllByAttributes(array('status_id'=>1));
        $myHtml = $this->renderPartial('extend', array('result'=>$result),true); 
        echo $myHtml;
        Yii::app()->end();
        return;
    }
    public function actionRepairAjax($status_id) {
        switch ($status_id) {
            case (3):
                $status_id = 6;
                break;
            case (6):
                $status_id = 3;
                break;
            default:
                echo'Ви вибрали не ту операцію';
                break;
        }
        $result = Products::model()->findAllByAttributes(array('status_id'=>array($status_id), 'model_id'=>array(1,2,3,4,5,6,7)));
        $myHtml = $this->renderPartial('extend', array('result'=>$result, 'status_id'=>$status_id), true);
        echo $myHtml;
        Yii::app()->end();
        return;
    }
//    public function actionReturnsOfRepair() {
//        
//    }

    public function actionExtendAjax($array_prod_id) {
        $m_orders = new Orders();
        $strings = $array_prod_id;
        $string = strip_tags(str_replace(array('[', '"', ']'),'', "$strings"));
        $array_prod_id = explode(",", $string);
        $result = Products::model()->findAllByAttributes(array('prod_id'=>$array_prod_id));
        $myHtml = $this->renderPartial('ex_result',  array(
            'array_prod_id' => $string,
            'result'=>$result
        ));
        echo $myHtml;
        Yii::app()->end();
        return;
     }    
     // выбор оборудования по номеру накладной
     public function orders_num_array(array $elements) {
//         $array_elements = array();
         foreach ($elements as $unit) {
             $array_elements[] = $unit->order_num;
         }
         return $array_elements;
     }
     public function street_kod_array(array $elements) {
//         $array_street_kod = array();
         foreach ($elements as $unit) {
             $array_street_kod[] = $unit->street_kod; 
         }
         return $array_street_kod;
     }
     public function getAddress(array $elements) {
         foreach ($elements as $unit) {
             $array_elements[] = $unit->street_id;
         }
         return $array_elements;
     }
     public function getHouse_number(array $elements) {
         foreach ($elements as $unit) {
             $array_elements[] = $unit->house_number;
         }
         return $array_elements;
     }
     public function itemArray(array $elements) {
//         $array_elements = array();
         foreach ($elements as $unit) {
             $array_elements[] = $unit->prod_id;
         }
         return $array_elements;
     }

     public function Select_DB($sql) {
            $connection = Yii::app()->db;
            $command = $connection->createCommand($sql);
            $products = $command->queryAll();
//            foreach ($products as $product){
//                foreach ($product as $item) {
//                    echo $item.'<br>';
//                }
//                echo '<hr>';
//            }
        return $products;
     }
     public function Insert_DB($sql) {
            $connection = Yii::app()->db;
            $command = $connection->createCommand($sql);
            $command->execute();
     }
     public function streetKod($street_id, $house_number, $m_orders){
            if($street_id >= 100)
                $street_id = '00'.$street_id;
            else
                $street_id = '000'.$street_id;
            $long = strlen($house_number);
            if(ctype_digit($house_number)) {
                if(1==$long)
                    $house_number = '00'.$house_number.'0';
                else if(2==$long)
                    $house_number = '0'.$house_number.'0';
                else if(3==$long)
                    $house_number = $house_number.'0';
                $m_orders->street_kod = $street_id.$house_number;
            } else {
                if(3==$long) {
                    $house_number='00'.$house_number;
                }
                else if(4==$long) {
                    $house_number='0'.$house_number;
                }
                $m_orders->street_kod = $street_id. $house_number;
            }
            return $m_orders->street_kod;
     }
      public function actionAutoComplete() {
            if(isset($_GET['q'])) {
                $criteria = new CDbCriteria;
                $criteria->condition = 'order_num LIKE :orders';
                $criteria->params = array(':orders'=>$_GET['q'].'%');
                
                if(isset($_GET['limit']) && is_numeric($_GET['limit'])) {
                    $criteria->limit = $_GET['limit'];
                }
                
                $orders = Orders::model()->findAll($criteria);
                $resStr = '';
                foreach ($orders as $order) {
                    $resStr .= $order->order_num."\n";
                }
                echo $resStr;
            }
        }

     public function loadModel($order_num) {
            $m_orders = Orders::model()->findByPk($order_num);
            if($m_orders === null)
                throw new CHttpException(404, 'Номера накладної яку Ви запитували, не існує!');
            return $m_orders;
     }
}