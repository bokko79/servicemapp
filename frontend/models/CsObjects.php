<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "cs_objects".
 *
 * @property string $id
 * @property string $name
 * @property integer $object_type_id
 * @property string $object_id
 * @property string $class
 * @property integer $favour
 * @property string $image_id
 * @property string $description
 *
 * @property CsObjects[] $csObjects
 * @property CsObjectIssues[] $csObjectIssues
 * @property CsObjectTypes $objectType
 * @property Images $image
 * @property User $addedBy
 * @property CsObjectsTranslation[] $csObjectsTranslations
 * @property CsServices[] $csServices
 * @property CsSpecs[] $csSpecs
 * @property UserObjects[] $userObjects
 */
class CsObjects extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cs_objects';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['object_type_id', 'object_id', 'level', 'favour', 'image_id'], 'integer'],
            [['class', 'description'], 'string'],
            [['name'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
            'object_type_id' => Yii::t('app', 'Object Type ID'),
            'object_id' => Yii::t('app', 'Object ID'),
            'class' => Yii::t('app', 'Class'),
            'favour' => Yii::t('app', 'Favour'),
            'image_id' => Yii::t('app', 'Image ID'),
            'description' => Yii::t('app', 'Description'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIssues()
    {
        return $this->hasMany(CsObjectIssues::className(), ['object_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProducts()
    {
        return $this->hasMany(CsProducts::className(), ['object_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOType()
    {
        return $this->hasOne(CsObjectTypes::className(), ['id' => 'object_type_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getImage()
    {
        return $this->hasOne(Images::className(), ['id' => 'image_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getT()
    {
        return $this->hasMany(CsObjectsTranslation::className(), ['object_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getServices()
    {
        return $this->hasMany(CsServices::className(), ['object_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getModels()
    {
        //return $this->hasMany(CsObjects::className(), ['object_id' => 'id']);
        $models = [];
        if ($objectProperties = $this->objectProperties){
            foreach ($objectProperties as $key => $objectProperty) {
                if($objectProperty->property_type=='model' and $objectPropertyValues = $objectProperty->objectPropertyValues){
                    foreach ($objectPropertyValues as $objectPropertyValue){
                        if($object = $objectPropertyValue->object){
                            $models[] = $object;
                        }                        
                    }
                }
            }
        }

        return $models;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getParent()
    {
        return $this->hasOne(CsObjects::className(), ['id' => 'object_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getObjectProperties()
    {
        return $this->hasMany(CsObjectProperties::className(), ['object_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserObjects()
    {
        return $this->hasMany(UserObjects::className(), ['object_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrderObjectModels()
    {
        return $this->hasMany(OrderServiceObjectModels::className(), ['object_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPresentationObjectModels()
    {
        return $this->hasMany(PresentationObjectModels::className(), ['object_model_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTranslation()
    {
        $object_translation = \frontend\models\CsObjectsTranslation::find()->where('lang_code="SR" and object_id='.$this->id)->one();
        if($object_translation) {
            return $object_translation;
        }
        return false;        
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTName()
    {
        if($this->getTranslation()) {
            return $this->getTranslation()->name;
        }       
        return false;   
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSCaseName()
    {
        return c($this->tName); 
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTNameGen()
    {
        if($this->getTranslation()) {
            return $this->getTranslation()->name_gen;
        }       
        return false;   
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTNameDat()
    {
        if($this->getTranslation()) {
            return $this->getTranslation()->name_dat;
        }       
        return false;   
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTNameAkk()
    {
        if($this->getTranslation()) {
            return $this->getTranslation()->name_akk;
        }       
        return false;   
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTNameInst()
    {
        if($this->getTranslation()) {
            return $this->getTranslation()->name_inst;
        }       
        return false;   
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTNamePl()
    {
        if($this->getTranslation()) {
            return $this->getTranslation()->name_pl;
        }       
        return false;   
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTNamePlGen()
    {
        if($this->getTranslation()) {
            return $this->getTranslation()->name_pl_gen;
        }       
        return false;   
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTGender()
    {
        if($this->getTranslation()) {
            return $this->getTranslation()->name_gender;
        }       
        return false;   
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function isModel()
    {
        return $this->class=='model' ? true : false;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function isPart()
    {
        return $this->class=='part' ? true : false;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function isAbstract()
    {
        return $this->class=='abstract' ? true : false;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function isObject()
    {
        return $this->class=='object' ? true : false;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPath($object)
    {
        $path = [];
        $level = $object->level;
        $parent = $object->parent;
        
        if ($level>1)
        {            
            $path[$level-1] = $parent;     
            $path = array_merge($this->getpath($parent), $path);
        }

        return $path;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProperties($object)
    {
        $properties = [];
        if($objectProperties = $object->objectProperties){
            foreach($objectProperties as $objectProperty){
                if(!in_array($objectProperty, $properties)){
                    $properties[] = $objectProperty;
                }
            }
        }
            
        if($object->getPath($object)){
            foreach ($this->getPath($this) as $key => $objectpp) {
                if($objectPropertiespp = $objectpp->objectProperties){
                    foreach($objectPropertiespp as $objectPropertypp){
                        if($objectPropertypp->property_class!='private' and !in_array($objectPropertypp, $properties)){
                            $properties[] = $objectPropertypp;
                        }
                    }
                }                    
            }
        }
        return $properties;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTNameWithMedia()
    {
        $image = yii\helpers\Html::img('@web/images/cards/info/info_docs'.rand(0, 9).'.jpg', ['style'=>'width:100%; height:110px; margin: 5px 0 10px']);
        
        return c($this->tName) . $image;         
    }
}
