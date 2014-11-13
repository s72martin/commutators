<?php

/**
 * This is the model class for table "OrderItem".
 *
 * The followings are the available columns in table 'OrderItem':
 * @property string $order_num
 * @property integer $order_item
 * @property integer $prod_id
 * @property integer $quantity
 * @property integer $unit_id
 */
class OrderItem extends CActiveRecord {
	/**
	 * @return string the associated database table name
	 */
	public function tableName() {
		return 'OrderItem';
	}

        public function primaryKey() {
            return array('order_num', 'order_item');
        }
	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules() {
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
//			array('order_item, prod_id, quantity, unit_id', 'required'),
                        array('order_item', 'required'),
			array('order_item, prod_id, quantity, unit_id', 'numerical', 'integerOnly'=>true),
			array('order_num', 'length', 'max'=>15),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('order_num, order_item, prod_id, quantity, unit_id', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations() {
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
                    'orders' => array(self::BELONGS_TO, 'Orders', 'order_num'),
                    'products' => array(self::BELONGS_TO, 'Products', 'prod_id')
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels() {
		return array(
			'order_num' => 'Order Num',
			'order_item' => 'Order Item',
			'prod_id' => 'Prod',
			'quantity' => 'Quantity',
			'unit_id' => 'Unit',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search() {
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('order_num',$this->order_num,true);
		$criteria->compare('order_item',$this->order_item);
		$criteria->compare('prod_id',$this->prod_id);
		$criteria->compare('quantity',$this->quantity);
		$criteria->compare('unit_id',$this->unit_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

        public function arrayOrderItem($order_num) {
            $m_orderItem = OrderItem::model()->findAllByAttributes(array('order_num'=>$order_num));
//            $array_prod_id = Products::itemArray($m_orderItem);
            return $m_orderItem;
        }
        
        public function orderItemArray(array $elements) {
            foreach ($elements as $unit) {
                $array_elements[] = $unit->prod_id;
            }
            
            return $array_elements;
        }
	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return OrderItem the static model class
	 */
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}
}
