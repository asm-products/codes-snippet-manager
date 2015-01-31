<?php

/**
 * This is the model class for table "icbac_thoughtcast".
 *
 * The followings are the available columns in table 'icbac_thoughtcast':
 * @property integer $id
 * @property integer $user_id
 * @property string $date
 * @property string $content
 * @property string $title
 * @property string $excerpt
 * @property integer $status
 * @property string $priority
 * @property string $menu_name
 * @property integer $category_id
 *
 * The followings are the available model relations:
 * @property IcbacMetaValues[] $icbacMetaValues
 * @property IcbacUser $user
 */
class Thoughtcast extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Thoughtcast the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'icbac_thoughtcast';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('title, excerpt, priority, cast_type, category_id', 'required'),
			array('status, category_id, archive', 'numerical', 'integerOnly'=>true),
			array('title, excerpt', 'length', 'max'=>255),
			array('priority', 'length', 'max'=>50),
			array('menu_name', 'length', 'max'=>128),
			array('date_added, content,type,archive', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, user_id, content, title, excerpt, status, priority, cast_type, category_id,type,date_added,archive', 'safe', 'on'=>'search'),
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
			'icbacMetaValues' => array(self::HAS_MANY, 'IcbacMetaValues', 'cast_id'),
			'users' => array(self::BELONGS_TO, 'Users', 'user_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'user_id' => 'User',
			'date_added' => 'Date',
			'content' => 'Content',
			'title' => 'Title',
			'excerpt' => 'Excerpt',
			'status' => 'Status',
			'priority' => 'Priority',
			'cast_type' => 'Cast Type',
			'category_id' => 'Category',
			'archive' => 'Archive'
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('date_added',$this->date_added,true);
		$criteria->compare('content',$this->content,true);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('excerpt',$this->excerpt,true);
		$criteria->compare('status',$this->status);
		$criteria->compare('priority',$this->priority,true);
		$criteria->compare('cast_type',$this->cast_type,true);
		$criteria->compare('category_id',$this->category_id);
		$criteria->compare('archive',$this->is_archive);
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
}