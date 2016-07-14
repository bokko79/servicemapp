<?php

namespace common\models;

use Yii;
use yii\imagine\Image;
use yii\helpers\Html;

/**
 * This is the model class for table "cs_objects".
 *
 * @property integer $id
 * @property string $name
 * @property string $object_id 
 * @property integer $level 
 * @property integer $object_type_id
 * @property string $class
 * @property integer $favour
 * @property string $file_id
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

    public $imageFile; 

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
            [['name'], 'unique'],
            [['object_type_id', 'object_id', 'level', 'favour', 'file_id'], 'integer'],
            [['class'], 'string'],
            [['name'], 'string', 'max' => 50],
            [['imageFile'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg, jpeg, gif'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Ime predmeta'),
            'object_type_id' => Yii::t('app', 'Object Type ID'),
            'level' => Yii::t('app', 'Level'), 
            'object_id' => Yii::t('app', 'Parent ID'),
            'class' => Yii::t('app', 'Klasa'),
            'favour' => Yii::t('app', 'Da li je moguće snimiti?'),
            'file_id' => Yii::t('app', 'File ID'),
        ];
    }

    public function upload()
    {
        if ($this->validate()) {

            if($this->file and $this->file_id != 2 and file_exists(Yii::getAlias('images/objects/thumbs/'.$this->file->ime)) and file_exists(Yii::getAlias('images/objects/'.$this->file->ime))){
                unlink(Yii::getAlias('images/objects/thumbs/'.$this->file->ime));
                unlink(Yii::getAlias('images/objects/'.$this->file->ime));
            }
           
            $fileName = $this->id . '_' . time();
            $this->imageFile->saveAs('images/objects/' . $fileName . '1.' . $this->imageFile->extension);         
            
            $image = new \common\models\Files();
            $image->ime = $fileName . '.' . $this->imageFile->extension;
            $image->type = 'image';
            $image->date = date('Y-m-d H:i:s');
            
            $thumb = 'images/objects/'.$fileName.'1.'.$this->imageFile->extension;
            Image::thumbnail($thumb, 400, 300)->save(Yii::getAlias('images/objects/'.$fileName.'.'.$this->imageFile->extension), ['quality' => 80]);                
            Image::thumbnail($thumb, 80, 64)->save(Yii::getAlias('images/objects/thumbs/'.$fileName.'.'.$this->imageFile->extension), ['quality' => 80]); 
            
            $image->save();

            if($image->save()){
                $this->file_id = $image->id;
                $this->imageFile = null;
                $this->save();
            }

            unlink(Yii::getAlias($thumb));
            
            return true;
        } else {
            return false;
        }
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
    public function getOType()
    {
        return $this->hasOne(CsObjectTypes::className(), ['id' => 'object_type_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFile()
    {
        return $this->hasOne(Files::className(), ['id' => 'file_id']);
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
    public function getParent()
    {
        return $this->hasOne(CsObjects::className(), ['id' => 'object_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getChildren()
    {
        return $this->hasMany(CsObjects::className(), ['object_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSiblings()
    {
        return $this->parent->children;
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
    public function getTags()
    {
        $tags = CsTags::find()->where('lang_code="SR" and entity_id='.$this->id .' and entity="object"')->all();

        return $tags ? $tags : false;        
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
    public function getObjectProperties()
    {
        return $this->hasMany(CsObjectProperties::className(), ['object_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getObjectPropertyValues()
    {
        return $this->hasMany(CsObjectPropertyValues::className(), ['object_id' => 'id']);
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
        $object_translation = CsObjectsTranslation::find()->where('lang_code="SR" and object_id='.$this->id)->one();
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
        return Yii::$app->operator->sentenceCase($this->tName); 
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
    public function getTHint()
    {
        if($this->getTranslation()) {
            return $this->getTranslation()->hint;
        }       
        return false;   
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTDescription()
    {
        if($this->getTranslation()) {
            return $this->getTranslation()->description;
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
    public function getInheritedProperties($object)
    {
        $properties = [];
            
        if($object->getPath($object)){
            foreach ($this->getPath($this) as $key => $objectpp) {
                if($objectPropertiespp = $objectpp->objectProperties){
                    foreach($objectPropertiespp as $objectPropertypp){
                        if($objectPropertypp->property_class!='private'){
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
    /*public function getTNameWithMedia()
    {
        $image = yii\helpers\Html::img('@web/images/objects/'.$this->file->ime, ['style'=>'width:100%; height:110px; margin: 5px 0 10px']);
        
        return c($this->tName) . $image;         
    }*/

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTNameWithHint()
    {
        if ($this->hint!=null) {
            return $this->label . '<span data-container="body" data-toggle="popover" data-placement="top" data-content="'.$this->tHint.'">
                 <i class="fa fa-question-circle gray-color"></i>
                </span>'; 
        } else {
            return $this->label;
        }               
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTNameWithMedia()
    {
        $image = yii\helpers\Html::img('@web/images/cards/info/info_docs'.rand(0, 9).'.jpg', ['style'=>'width:100%; height:110px; margin: 5px 0 10px']);
        if ($this->hint!=null) {
            return $this->label . '<span data-container="body" data-toggle="popover" data-placement="top" data-content="'.$this->tHint.'">
                 <i class="fa fa-question-circle gray-color"></i>
                </span>' . $image; 
        } else {
            return $this->label . $image;
        } 
    }
}
