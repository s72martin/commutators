<?php

/**
 * This is the model class for table "Orders".
 *
 * The followings are the available columns in table 'Orders':
 * @property integer $order_num
 * @property integer $order_date
 * @property integer $coworker_id
 * @property integer $street_id
 * @property string $house_number
 * @property string $street_kod
 * @property integer $status_id
 * @property integer $stockroom_id
 * @property string $order_comment
 */
class Orders extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'Orders';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('order_num, order_date, coworker_id, street_id, house_number, status_id', 'required'),
			array('coworker_id, street_id, status_id, stockroom_id', 'numerical', 'integerOnly'=>true),
                        array('order_num', 'length', 'max'=>15),
			array('house_number', 'length', 'max'=>5),
			array('street_kod', 'length', 'max'=>9),
			array('order_comment', 'length', 'max'=>256),
                        array('order_num', 'unique'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('order_num, order_date, coworker_id, street_id, house_number, street_kod, status_id, stockroom_id, order_comment', 'safe', 'on'=>'search'),
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
                    'orderItem' => array(self::HAS_MANY, 'OrderItem', array('order_num'=>'order_num')),
                    'coworkers' => array(self::BELONGS_TO, 'Coworkers', 'coworker_id'),
                    'streets' => array(self::BELONGS_TO, 'Streets', 'street_id'),
                    'status' => array(self::BELONGS_TO, 'Status', 'status_id'),
                    'stockrooms' => array(self::BELONGS_TO, 'Stockrooms', 'stockroom_id')
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'order_num' => 'Номер накладної',
			'order_date' => 'від',
			'coworker_id' => 'Кому видано',
			'street_id' => 'Назва вулиці',
			'house_number' => 'будинок №',
			'street_kod' => 'Код вулиці',
			'status_id' => 'Статус',
			'stockroom_id' => 'Склад',
			'order_comment' => 'Коментарі',
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

		$criteria->compare('order_num',$this->order_num);
		$criteria->compare('order_date',$this->order_date);
		$criteria->compare('coworker_id',$this->coworker_id);
		$criteria->compare('street_id',$this->street_id);
		$criteria->compare('house_number',$this->house_number,true);
		$criteria->compare('street_kod',$this->street_kod,true);
		$criteria->compare('status_id',$this->status_id);
		$criteria->compare('stockroom_id',$this->stockroom_id);
		$criteria->compare('order_comment',$this->order_comment,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
        
            protected function beforeSave() {
                if(parent::beforeSave()) {
                    $this->order_date = strtotime($this->order_date);
                    return true;
                } else {
                    return false;
                }
            }
 
            protected function afterFind() {
                $date = date('d.m.Y', $this->order_date);
                $this->order_date = $date;
                parent::afterFind();
            } 
            
            public function listValue() {
//                $result = Coworkers::model()->findAll();
                $list = CHtml::listData(Coworkers::model()->findAll(), 'coworker_id', 'coworker_name');
                return $list;
            }
            
            /**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Orders the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
