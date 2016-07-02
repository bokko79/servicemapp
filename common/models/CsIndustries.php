<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "cs_industries".
 *
 * @property integer $id
 * @property string $name
 * @property integer $category_id
 * @property string $image_id
 * @property string $status
 * @property string $hit_counter
 *
 * @property Banners[] $banners
 * @property CsActions[] $csActions
 * @property Images $image
 * @property CsCategories $category
 * @property User $addedBy
 * @property CsIndustriesTranslation[] $csIndustriesTranslations
 * @property CsServices[] $csServices
 * @property CsSimilarIndustries[] $csSimilarIndustries
 * @property CsSimilarIndustries[] $csSimilarIndustries0
 * @property CsSkills[] $csSkills
 * @property Provider[] $providers
 * @property ProviderServices[] $providerServices
 * @property UserServices[] $userServices
 */
class CsIndustries extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cs_industries';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['code', 'name'], 'required'],
            [['code', 'category_id', 'image_id', 'added_by', 'hit_counter'], 'integer'],
            [['subtitle', 'status', 'description'], 'string'],
            [['added_time'], 'safe'],
            [['name'], 'string', 'max' => 60]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'code' => 'Jedinstvena šifra delatnosti.',
            'name' => 'Ime delatnosti.',
            'category_id' => 'Kategorija uslužne delatnosti.',
            'image_id' => 'Slika delatnosti.',
            'subtitle' => 'Podnaslov delatnosti.',
            'status' => 'Status',
            'added_by' => 'Added By',
            'added_time' => 'Added Time',
            'hit_counter' => 'Broj poseta delatnosti.',
            'description' => 'Opis delatnosti.',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBanners()
    {
        return $this->hasMany(Banners::className(), ['industry_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getActions()
    {
        return $this->hasMany(CsActions::className(), ['industry_id' => 'id']);
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
    public function getCategory()
    {
        return $this->hasOne(CsCategories::className(), ['id' => 'category_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSector()
    {
        return $this->category->sector;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIcon()
    {
        return $this->sector->icon;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getColor()
    {
        return $this->sector->color;
    }
    

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getT()
    {
        return $this->hasMany(CsIndustriesTranslation::className(), ['industry_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getServices()
    {
        return $this->hasMany(CsServices::className(), ['industry_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPresentations()
    {
        $cont = [];
        if($services = $this->services){
            foreach($services as $service){
                if($presentations = $service->presentations){
                    foreach($presentations as $presentation){
                        $cont[] = $presentation;
                    }
                }
            }
        }
        return $cont;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrders()
    {
        $cont = [];
        if($services = $this->services){
            foreach($services as $service){
                if($orders = $service->orders){
                    foreach($orders as $order){
                        $cont[] = $order;
                    }
                }
            }
        }
        return $cont;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPromotions()
    {
        $cont = [];
        if($services = $this->services){
            foreach($services as $service){
                if($promotions = $service->promotionServices){
                    foreach($promotions as $promotion){
                        $cont[] = $promotion;
                    }
                }
            }
        }
        return $cont;
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSimilarIndustries()
    {
        return $this->hasMany(CsSimilarIndustries::className(), ['industry_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSimilarIndustries0()
    {
        return $this->hasMany(CsSimilarIndustries::className(), ['similar_industry_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIndustryProperties()
    {
        return $this->hasMany(CsIndustryProperties::className(), ['industry_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProviders()
    {
        return $this->hasMany(Provider::className(), ['industry_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProviderServices()
    {
        return $this->hasMany(ProviderServices::className(), ['industry_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserServices()
    {
        return $this->hasMany(UserServices::className(), ['industry_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTranslation()
    {
        $industry_translation = \common\models\CsIndustriesTranslation::find()->where('lang_code="SR" and industry_id='.$this->id)->one();
        if($industry_translation) {
            return $industry_translation;
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
        if($this->tName) {
            return c($this->tName);
        }       
        return false;   
    }

    public static function getAllIndustriesByCategories() {
        $options = [];
         
        $parents = CsCategories::find()->all();
        foreach($parents as $key => $p) {
            $children = self::find()->where("category_id=:parent_id", [":parent_id"=>$p->id])->all();
            $children = self::find()->where("category_id=:parent_id", [":parent_id"=>$p->id])->all(); 
            $options[$p->name] = yii\helpers\ArrayHelper::map($children, 'id', 'tName');

            /*$child_options = [];
            foreach($children as $child) {
                $child_options[$child->id] = $child->tName;
            }
            $options[$p->tName] = $child_options;*/
        }
        return $options;
    }

    // count services    
    public function getCountServices() {
        return $this->services ? count($this->services) : 0;
    }
    // orders, active orders, successful orders
    // providers, active providers
    // presentations, active presentations
    // promotions, active promotions,
    // by location, by language, by time, by status
    // images, avatars, formats
    // special functions.. TBD
}
