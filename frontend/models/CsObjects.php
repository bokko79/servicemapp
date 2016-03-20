<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "cs_objects".
 *
 * @property integer $id
 * @property string $name
 * @property integer $object_type_id
 * @property integer $has_model 
 * @property string $object_id
 * @property string $type
 * @property integer $favour
 * @property string $image_id
 * @property string $status
 * @property string $added_by
 * @property string $added_time
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
            [['object_type_id', 'has_model', 'object_id', 'favour', 'image_id', 'added_by'], 'integer'],
            [['status', 'description', 'type'], 'string'],
            [['added_time'], 'safe'],
            [['name'], 'string', 'max' => 50],
            [['added_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['added_by' => 'id']],
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
            'has_model' => Yii::t('app', 'Has Model'), 
            'object_id' => Yii::t('app', 'Object ID'), 
            'favour' => Yii::t('app', 'Favour'),
            'image_id' => Yii::t('app', 'Image ID'),
            'status' => Yii::t('app', 'Status'),
            'added_by' => Yii::t('app', 'Added By'),
            'added_time' => Yii::t('app', 'Added Time'),
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
    public function getType()
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
    public function getAddedBy()
    {
        return $this->hasOne(User::className(), ['id' => 'added_by']);
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
    public function getChild()
    {
        return $this->hasMany(CsObjects::className(), ['object_id' => 'id']);
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
    public function getSpecs()
    {
        return $this->hasMany(CsSpecs::className(), ['object_id' => 'id']);
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
        return $this->hasMany(OrderServiceObjectmodels::className(), ['object_id' => 'id']);
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
    public function getModels()
    {
        if($this->isPart()){
            return $this->parent->models;
        } else {
            return $this->hasMany(CsObjects::className(), ['object_id' => 'id'])->where('type="model"');
        }        
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getParts()
    {
        return $this->hasMany(CsObjects::className(), ['object_id' => 'id'])->where('type="part"');
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
    public function isModel()
    {
        return $this->type=='model' ? true : false;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function isPart()
    {
        return $this->type=='part' ? true : false;
    }
}
