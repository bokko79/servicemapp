<?php

namespace common\models;

use Yii;
use yii\imagine\Image;

/**
 * This is the model class for table "cs_services".
 *
 * @property integer $id
 * @property string $name
 * @property string $file_id
 * @property integer $industry_id
 * @property integer $action_id
 * @property integer $object_id
 * @property integer $object_model_relevance 
 * @property string $service_type
 * @property integer $unit_id
 * @property string $amount
 * @property integer $amount_default 
 * @property integer $amount_range_min 
 * @property integer $amount_range_max 
 * @property string $amount_range_step 
 * @property string $consumer 
 * @property string $consumer_children 
 * @property integer $consumer_default 
 * @property integer $consumer_range_min 
 * @property integer $consumer_range_max 
 * @property string $consumer_range_step 
 * @property string $service_object 
 * @property string $pic
 * @property string $location
 * @property string $time
 * @property string $duration
 * @property string $frequency 
 * @property string $support 
 * @property string $turn_key
 * @property string $tools
 * @property string $labour_type
 * @property string $frequency
 * @property string $coverage
 * @property integer $geospecific 
 * @property integer $process
 * @property string $dat
 * @property string $availability 
 * @property string $ordering 
 * @property string $pricing 
 * @property string $terms 
 * @property string $status
 * @property string $hit_counter
 *
 * @property CsRecommendedServices[] $csRecommendedServices
 * @property CsRecommendedServices[] $csRecommendedServices0
 * @property CsServiceProcesses[] $csServiceProcesses
 * @property CsServiceRegulations[] $csServiceRegulations
 * @property CsServiceSpecs[] $csServiceSpecs
 * @property CsObjects $object
 * @property CsUnits $unit
 * @property CsActions $action0
 * @property CsIndustries $industry
 * @property User $addedBy
 * @property CsServicesTranslation[] $csServicesTranslations
 * @property CsSimilarServices[] $csSimilarServices
 * @property CsSimilarServices[] $csSimilarServices0
 * @property OrderServices[] $orderServices
 * @property PromotionServices[] $promotionServices
 * @property ProviderServices[] $providerServices
 * @property ServiceComments[] $serviceComments
 * @property UserServices[] $userServices
 */
class CsServices extends \yii\db\ActiveRecord
{
    public $imageFile;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cs_services';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'industry_id', 'action_id', 'action_name', 'object_id', 'object_name', 'unit_id', 'coverage'], 'required'],
            [['file_id', 'industry_id', 'action_id', 'object_id', 'object_model_relevance', 'unit_id', 'amount_default', 'amount_range_min', 'amount_range_max', 'consumer_default', 'consumer_range_min', 'consumer_range_max', 'geospecific', 'process', 'added_by', 'hit_counter'], 'integer'],
            [['amount_range_step', 'consumer_range_step'], 'number'], 
            [['dat', 'status'], 'string'],
            [['name'], 'string', 'max' => 90],
            [['service_type', 'amount', 'consumer', 'consumer_children', 'service_object', 'pic', 'location', 'time', 'duration', 'frequency', 'support', 'turn_key', 'tools', 'labour_type', 'coverage', 'availability', 'ordering', 'pricing', 'terms'], 'string', 'max' => 1],
            [['unit_id'], 'exist', 'skipOnError' => true, 'targetClass' => CsUnits::className(), 'targetAttribute' => ['unit_id' => 'id']],
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
            'name' => Yii::t('app', 'Name'),
            'file_id' => Yii::t('app', 'Image ID'), 
            'industry_id' => Yii::t('app', 'Industry ID'),
            'action_id' => Yii::t('app', 'Action ID'),
            'object_id' => Yii::t('app', 'Object ID'),
            'object_model_relevance' => Yii::t('app', 'Object Model Relevance'), 
            'service_type' => Yii::t('app', 'Service Type'), 
            'amount' => Yii::t('app', 'Amount'),
            'amount_default' => Yii::t('app', 'Amount Default'), 
            'amount_range_min' => Yii::t('app', 'Amount Range Min'), 
            'amount_range_max' => Yii::t('app', 'Amount Range Max'), 
            'amount_range_step' => Yii::t('app', 'Amount Range Step'), 
            'consumer' => Yii::t('app', 'Consumer'), 
            'consumer_children' => Yii::t('app', 'Consumer Children'), 
            'consumer_default' => Yii::t('app', 'Consumer Default'), 
            'consumer_range_min' => Yii::t('app', 'Consumer Range Min'), 
            'consumer_range_max' => Yii::t('app', 'Consumer Range Max'), 
            'consumer_range_step' => Yii::t('app', 'Consumer Range Step'), 
            'service_object' => Yii::t('app', 'Service Object'), 
            'pic' => Yii::t('app', 'Pic'),
            'location' => Yii::t('app', 'Location'),
            'time' => Yii::t('app', 'Time'),
            'duration' => Yii::t('app', 'Duration'),
            'frequency' => Yii::t('app', 'Frequency'), 
            'support' => Yii::t('app', 'Support'), 
            'turn_key' => Yii::t('app', 'Turn Key'),
            'tools' => Yii::t('app', 'Tools'),
            'labour_type' => Yii::t('app', 'Labour Type'),
            'coverage' => Yii::t('app', 'Coverage'),
            'geospecific' => Yii::t('app', 'Geospecific'), 
            'process' => Yii::t('app', 'Process'),
            'dat' => Yii::t('app', 'Dat'),
            'availability' => Yii::t('app', 'Availability'), 
            'ordering' => Yii::t('app', 'Ordering'), 
            'pricing' => Yii::t('app', 'Pricing'), 
            'terms' => Yii::t('app', 'Terms'), 
            'status' => Yii::t('app', 'Status'),
            'hit_counter' => Yii::t('app', 'Hit Counter'),
        ];
    }

    public function upload()
    {
        if ($this->validate()) {

            if($this->file and $this->file_id != 2){
                unlink(Yii::getAlias('images/services/thumbs/'.$this->file->ime));
                unlink(Yii::getAlias('images/services/'.$this->file->ime));
            }
           
            $fileName = $this->id . '_' . $this->name;
            $this->imageFile->saveAs('images/services/' . $fileName . '1.' . $this->imageFile->extension);         
            
            $image = new \common\models\Images();
            $image->ime = $fileName . '.' . $this->imageFile->extension;
            $image->type = 'image';
            $image->date = date('Y-m-d H:i:s');
            
            $thumb = 'images/services/'.$fileName.'1.'.$this->imageFile->extension;
            Image::thumbnail($thumb, 400, 300)->save(Yii::getAlias('images/services/'.$fileName.'.'.$this->imageFile->extension), ['quality' => 80]);                
            Image::thumbnail($thumb, 80, 64)->save(Yii::getAlias('images/services/thumbs/'.$fileName.'.'.$this->imageFile->extension), ['quality' => 80]); 
            
            $image->save();

            if($image->save()){
                $this->file_id = $image->id;
                $this->imageFile = null;
                $this->save();
            }

            unlink(Yii::getAlias($thumb));
            
            return;
        } else {

            return false;
        }
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRecommendedServices()
    {
        return $this->hasMany(CsRecommendedServices::className(), ['service_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRecommendedServices0()
    {
        return $this->hasMany(CsRecommendedServices::className(), ['rcmd_service_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getServiceProcesses()
    {
        return $this->hasMany(CsServiceProcesses::className(), ['service_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getServiceRegulations()
    {
        return $this->hasMany(CsServiceRegulations::className(), ['service_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getServiceObjectModels()
    {
        return $this->hasMany(CsServiceObjectModels::className(), ['service_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getServiceIndustryProperties()
    {
        return $this->hasMany(CsServiceIndustryProperties::className(), ['service_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getServiceActionProperties()
    {
        return $this->hasMany(CsServiceActionProperties::className(), ['service_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getServiceObjectProperties()
    {
        return $this->hasMany(CsServiceObjectProperties::className(), ['service_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getObject()
    {
        return $this->hasOne(CsObjects::className(), ['id' => 'object_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPartContainer()
    {
        return $this->hasOne(CsObjects::className(), ['id' => 'object_container_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUnit()
    {
        return $this->hasOne(CsUnits::className(), ['id' => 'unit_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUnits()
    {
        return $this->hasMany(CsServiceUnits::className(), ['service_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAction()
    {
        return $this->hasOne(CsActions::className(), ['id' => 'action_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIndustry()
    {
        return $this->hasOne(CsIndustries::className(), ['id' => 'industry_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getT()
    {
        return $this->hasMany(CsServicesTranslation::className(), ['service_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSimilarServices()
    {
        return $this->hasMany(CsSimilarServices::className(), ['service_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSimilarServices0()
    {
        return $this->hasMany(CsSimilarServices::className(), ['sim_service_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrderServices()
    {
        return $this->hasMany(OrderServices::className(), ['service_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPresentations()
    {
        return $this->hasMany(Presentations::className(), ['service_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPromotionServices()
    {
        return $this->hasMany(PromotionServices::className(), ['service_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProviderServices()
    {
        return $this->hasMany(ProviderServices::className(), ['service_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getServiceComments()
    {
        return $this->hasMany(ServiceComments::className(), ['service_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserServices()
    {
        return $this->hasMany(UserServices::className(), ['service_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAvatar()
    {
        return ($this->object->file) ? $this->object->file->ime : false;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAveragePrice()
    {
        return '2.499,99&nbsp;RSD/m<sup>2</sup>';
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTranslation()
    {
        $service_translation = CsServicesTranslation::find()->where('lang_code="SR" and service_id='.$this->id)->one();
        if($service_translation) {
            return $service_translation;
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
    public function getSCaseName()
    {
        return c($this->tName); 
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTNote()
    {
        if($this->getTranslation()) {
            return $this->getTranslation()->note;
        }       
        return false;   
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTSubnote()
    {
        if($this->getTranslation()) {
            return $this->getTranslation()->note;
        }       
        return false;   
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTHintOrder()
    {
        if($this->getTranslation()) {
            return $this->getTranslation()->hint_order;
        }       
        return false;   
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTHintPresentation()
    {
        if($this->getTranslation()) {
            return $this->getTranslation()->hint_presentation;
        }       
        return false;   
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getObjectModelsList()
    {
        /*if($this->serviceObjectModels):
            $model_list = \yii\helpers\ArrayHelper::map($this->serviceObjectModels, 'model', 'sCaseModelName');
        else:*/
        $model_list = \yii\helpers\ArrayHelper::map($this->object->models, 'id', 'tNameWithMedia');
        /*endif;*/

        return $model_list;
    }
}
