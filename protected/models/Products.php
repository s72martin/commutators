<?php

/**
 * This is the model class for table "Products".
 *
 * The followings are the available columns in table 'Products':
 * @property integer $prod_id
 * @property integer $type_id
 * @property integer $model_id
 * @property string $prod_snum
 * @property integer $prod_quant
 * @property integer $unit_id
 * @property integer $manuf_id
 * @property integer $status_id
 * @property string $prod_comment
 */
class Products extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'Products';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('type_id, model_id, prod_snum, prod_quant, unit_id, manuf_id, status_id', 'required'),
			array('exchange_id, type_id, model_id, prod_quant, unit_id, manuf_id, status_id', 'numerical', 'integerOnly'=>true),
			array('prod_snum', 'length', 'max'=>15),
                        array('prod_snum', 'unique'),
                        array('street_kod', 'length', 'max'=>9),
			array('prod_comment', 'length', 'max'=>256),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('prod_id, exchange_id, type_id, model_id, prod_snum, prod_quant, unit_id, manuf_id, status_id, prod_comment', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
                    'models' => array(self::BELONGS_TO, 'Models', 'model_id'),
                    'types' => array(self::BELONGS_TO, 'Types', 'type_id'),
                    'units' => array(self::BELONGS_TO, 'Units', 'unit_id'),
                    'manufactures' => array(self::BELONGS_TO, 'Manufactures', 'manuf_id'),
                    'status' => array(self::BELONGS_TO, 'Status', 'status_id'),
                    'orderItem' => array(self::HAS_MANY, 'OrderItem', 'prod_id')
                );
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'prod_id' => 'Prod',
                        'exchange_id' => 'Замена',
			'type_id' => 'Тип комутатора',
			'model_id' => 'Модель комутатора',
			'prod_snum' => 'Серійний номер',
			'prod_quant' => 'Кількість',
			'unit_id' => 'Од. виміру',
			'manuf_id' => 'Виробник',
			'status_id' => 'Статус',
                        'street_kod' => 'Код вулиці',
			'prod_comment' => 'Коментарі',
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
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('prod_id',$this->prod_id);
                $criteria->compare('exchange_id',$this->exchange_id);
		$criteria->compare('type_id',$this->type_id);
		$criteria->compare('model_id',$this->model_id);
		$criteria->compare('prod_snum',$this->prod_snum,true);
		$criteria->compare('prod_quant',$this->prod_quant);
		$criteria->compare('unit_id',$this->unit_id);
		$criteria->compare('manuf_id',$this->manuf_id);
		$criteria->compare('status_id',$this->status_id);
                $criteria->compare('street_kod',$this->street_kod);
		$criteria->compare('prod_comment',$this->prod_comment,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
        public function get_Products() {
            $m_products = Products::model()->findAll();
            $list = CHtml::ListData($m_products, 'prod_id', 'prod_snum');
            return $list;
        }
        public function arrayProducts(array $orderItem) {
//            $array_products = OrderItem::orderItemArray($orderItem);
            $m_products = Products::model()->findAllByAttributes(array('prod_id'=>$orderItem));

            return $m_products;
        }
        public function itemArray(array $elements) {
            foreach ($elements as $unit) {
                $array_elements[] = $unit->prod_id;
            }
         return $array_elements;
        }
	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Products the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
