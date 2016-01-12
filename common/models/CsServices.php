<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "cs_services".
 *
 * @property integer $id
 * @property string $name
 * @property integer $industry_id
 * @property integer $action_id
 * @property string $action
 * @property integer $object_id
 * @property string $object_name
 * @property integer $unit_id
 * @property string $service_type
 * @property string $amount
 * @property string $pic
 * @property string $service_object
 * @property string $consumer_count
 * @property string $support
 * @property string $location
 * @property string $time
 * @property string $duration
 * @property string $turn_key
 * @property string $addinfo_tools
 * @property integer $skill_id
 * @property integer $regulation_id
 * @property string $labour_type
 * @property string $frequency
 * @property string $coverage
 * @property integer $process
 * @property integer $geospecific
 * @property string $dat
 * @property string $status
 * @property string $added_by
 * @property string $added_time
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
            [['name', 'industry_id', 'action_id', 'action', 'object_id', 'object_name', 'unit_id', 'frequency', 'coverage'], 'required'],
            [['industry_id', 'action_id', 'object_id', 'unit_id', 'skill_id', 'regulation_id', 'process', 'geospecific', 'added_by', 'hit_counter'], 'integer'],
            [['dat', 'status'], 'string'],
            [['added_time'], 'safe'],
            [['name'], 'string', 'max' => 90],
            [['action'], 'string', 'max' => 80],
            [['object_name'], 'string', 'max' => 60],
            [['service_type', 'amount', 'pic', 'service_object', 'consumer_count', 'support', 'location', 'time', 'duration', 'turn_key', 'addinfo_tools', 'labour_type', 'frequency', 'coverage'], 'string', 'max' => 1]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Ime usluge.',
            'industry_id' => 'ID delatnosti usluge.',
            'action_id' => 'ID akcije usluge.',
            'action' => 'Akcija usluge.',
            'object_id' => 'ID predmeta usluge.',
            'object_name' => 'Predmet usluge.',
            'unit_id' => 'Jedinica mere po kojoj se usluga izvršava.',
            'service_type' => 'CRUD tip usluge. 1 - Create; 2 - Read; 3 - Update; 4 - Delete; 5 - Rent; 41 - Zamena; 6 - Other.',
            'amount' => 'Obim usluge. 0 - no; 1 - obavezan; 2 - opciono.',
            'pic' => 'Slika predmeta usluge. 0 - no; 1 - opciono.',
            'service_object' => 'Predmet usluge. 0 - ne postoji; 1 - Predmet usluge je pružaočev (iznajmljivanje); 2 - Predmet usluge je korisnikov; 3 - neopipljiv.',
            'consumer_count' => 'Broj korisnika usluge. 0 - no; 1 - obavezno; 2 - opciono.',
            'support' => 'Podrška klijentima (Customer support). 0 - no; 1 - opciono.',
            'location' => 'Lokacija usluge. 0 - no; 1 - Lokacija korisnika; 2 - Lokacija korisnika startna i završna; 3 - Lokacija ili korisnika, a ako nije uneta onda pružaoca usluge; 4- Lokacija korisnika startna i završna (opciono); 5 - Lokacija pružaoca usluge.',
            'time' => 'Vreme izvršenje usluge. 0 - no; 1 - određuje korisnik; 2 - ASAP (određuje pružalac usluge); ',
            'duration' => 'Trajanje izvršenja usluge. 0 - no; 1 - obavezno; 2 - opciono; 3 - isto kao obim usluge (kad je izražen u vremenu).',
            'turn_key' => 'Važenje ponuđene cene za izvršenje usluge. 0 - no; 1 - ruke/ruke+materijal.',
            'addinfo_tools' => 'Alat za izvršenje usluge. 0 - no; 1 - korisnikov; 2 - pružaočev.',
            'skill_id' => 'Potrebna veština ili dozvola za obavljanje dozvole.',
            'regulation_id' => 'Zakon koji obuhvata izvršenje usluge.',
            'labour_type' => 'Vrsta korišćenog rada prilikom izvršenja usluge. 1 - oprema; 2 - čovek.',
            'frequency' => 'Učestalost izvršenja usluge. 0 - no; 1 - jednom; 2 - povratno (dvaput); 3 - frekventno; 4 - neodređeno.',
            'coverage' => 'Razdaljina koju pokrivaju pružaoci usluga. 0 - no; 1 - mala pokrivenost (nivo grada - do 10km); 2 - srednja (od 10 - 50km - region); 3 - velika (od 50 - 500km - država); 4 - neograničena (ceo svet). ',
            'process' => 'Usluga je deo procesa. Npr. zidanje kuće je usluga koja je deo procesa \"Izgradnja kuće\".',
            'geospecific' => 'Usluga je specifična za određeno podneblje, državu, region ili grad.',
            'dat' => 'DAT - default auction type: Podrazumevana vrsta zahteva za uslugu.',
            'status' => 'Status usluge.',
            'added_by' => 'Korisnik koji je uneo uslugu.',
            'added_time' => 'Vreme unošenja usluge.',
            'hit_counter' => 'Broj pregleda usluge.',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCsRecommendedServices()
    {
        return $this->hasMany(CsRecommendedServices::className(), ['service_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCsRecommendedServices0()
    {
        return $this->hasMany(CsRecommendedServices::className(), ['rcmd_service_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCsServiceProcesses()
    {
        return $this->hasMany(CsServiceProcesses::className(), ['service_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCsServiceRegulations()
    {
        return $this->hasMany(CsServiceRegulations::className(), ['service_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCsServiceSpecs()
    {
        return $this->hasMany(CsServiceSpecs::className(), ['service_id' => 'id']);
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
    public function getUnit()
    {
        return $this->hasOne(CsUnits::className(), ['id' => 'unit_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAction0()
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
    public function getAddedBy()
    {
        return $this->hasOne(User::className(), ['id' => 'added_by']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCsServicesTranslations()
    {
        return $this->hasMany(CsServicesTranslation::className(), ['service_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCsSimilarServices()
    {
        return $this->hasMany(CsSimilarServices::className(), ['service_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCsSimilarServices0()
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
     * @inheritdoc
     * @return CsServicesQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CsServicesQuery(get_called_class());
    }
}
