<?php

/**
 * This is the model class for table "Streets".
 *
 * The followings are the available columns in table 'Streets':
 * @property integer $street_id
 * @property integer $street_type
 * @property string $street_name
 */
class Streets extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'Streets';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('street_type, street_name', 'required'),
			array('street_type', 'numerical', 'integerOnly'=>true),
			array('street_name', 'length', 'max'=>256),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('street_id, street_type, street_name', 'safe', 'on'=>'search'),
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
                    'orders' => array(self::HAS_MANY, 'Orders', 'street_id'),
                    'streetType'=>array(self::BELONGS_TO, 'StreetType', 'street_type')
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'street_id' => 'Street',
			'street_type' => 'Street Type',
			'street_name' => 'Street Name',
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

		$criteria->compare('street_id',$this->street_id);
		$criteria->compare('street_type',$this->street_type);
		$criteria->compare('street_name',$this->street_name,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Streets the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
