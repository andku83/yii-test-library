<?php

/**
 * This is the model class for table "{{books}}".
 *
 * The followings are the available columns in table '{{books}}':
 * @property integer $id
 * @property string $name
 * @property string $date_create
 * @property string $date_update
 * @property string $preview
 * @property string $date
 * @property integer $author_id
 *
 * The followings are the available model relations:
 * @property Authors $author
 */
class Books extends CActiveRecord
{
    public $_date_from;
    public $_date_to;
    public $author_search;
    const PATH = '/../uploaded/images/';

    /**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{books}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, author_id', 'required'),
			array('author_id', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>255),
			array('preview', 'length', 'max'=>255),
			//array('preview', 'default', 'value'=>'default.png','setOnEmpty'=>true, 'on'=>'create'),
			array('date', 'default', 'value'=>date("Y-m-d", 0), 'setOnEmpty'=>true),
			//array('date_create, date_update, date', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, name, date_create, date_update, preview, date, author_id,
			    $_date_from, $_date_to, author_search', 'safe', 'on'=>'search'),
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
			'author' => array(self::BELONGS_TO, 'Authors', 'author_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => Yii::t('books','ID'),
			'name' => Yii::t('books','Name book'),
			'date_create' => Yii::t('books','Date Create'),
			'date_update' => Yii::t('books','Date Update'),
			'preview' => Yii::t('books','Preview'),
			'date' => Yii::t('books','Book release date'),
			'author_id' => Yii::t('books','Author'),
			'_date_from' => Yii::t('books','Book release date:'),
			'_date_to' => Yii::t('books','to'),
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

        $criteria->with = array( 'author' => array('id', 'fullName'));

/*        if(!empty($this->author_id)){
            //В фильтр id_author у нас есть возможность писать любой критерий поиска по имени или фамилии
            $criteria->addSearchCondition(
                'author_id',
                new CDbExpression( 'CONCAT(author.firstname, " ", author.lastname)' )
            );
        }
        if(!empty($this->name)){
            $criteria->addSearchCondition(
                'name',
                $this->name
            );
        }*/

        $criteria->compare('id',$this->id);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('date_create',$this->date_create,true);
		$criteria->compare('date_update',$this->date_update,true);
		$criteria->compare('preview',$this->preview,true);
		$criteria->compare('date',$this->date,true);
		$criteria->compare('author_id',$this->author_id);
        $criteria->compare('author_search', $this->author_search,true);

        $criteria->compare('_date_from',$this->_date_from,true);
        $criteria->compare('_date_to',$this->_date_to,true);

        return new CActiveDataProvider('Books', array(
            'criteria' => $criteria,
            'sort' => array(
                'attributes' => array(
                    'author_search' => array(
                        'asc' => 'author.fullName',
                        'desc' => 'author.fullName DESC',
                    ),
                    '*',
                ),
            ),
        ));

        /*		return new CActiveDataProvider($this, array(
                    'criteria'=>$criteria,
                ));*/
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Books the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

}
