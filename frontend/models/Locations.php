<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "locations".
 *
 * @property string $id
 * @property integer $is_fav
 * @property string $user_id
 * @property integer $def
 * @property string $ime
 * @property string $country
 * @property string $state
 * @property string $district
 * @property string $city
 * @property string $zip
 * @property string $mz
 * @property string $ulica
 * @property string $broj
 * @property integer $sprat
 * @property integer $stan
 * @property string $lat
 * @property string $lng
 * @property string $ime_lokacije
 *
 * @property Bids[] $bids
 * @property User $user
 * @property Orders[] $orders
 * @property Orders[] $orders0
 * @property Presentations[] $presentations
 * @property ProviderLocations[] $providerLocations
 * @property UserDetails[] $userDetails
 * @property UserLocations[] $userLocations
 * @property UserObjects[] $userObjects
 */
class Locations extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'locations';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['is_fav', 'user_id', 'def', 'zip', 'sprat', 'stan'], 'integer'],
            [['user_id', 'ime'], 'required'],
            [['lat', 'lng'], 'number'],
            [['ime'], 'string', 'max' => 100],
            [['country', 'state', 'district', 'city', 'mz', 'ulica'], 'string', 'max' => 64],
            [['broj'], 'string', 'max' => 4],
            [['ime_lokacije'], 'string', 'max' => 128],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'is_fav' => 'Is Fav',
            'user_id' => 'User ID',
            'def' => 'Def',
            'ime' => 'Ime',
            'country' => 'Country',
            'state' => 'State',
            'district' => 'District',
            'city' => 'City',
            'zip' => 'Zip',
            'mz' => 'Mz',
            'ulica' => 'Ulica',
            'broj' => 'Broj',
            'sprat' => 'Sprat',
            'stan' => 'Stan',
            'lat' => 'Lat',
            'lng' => 'Lng',
            'ime_lokacije' => 'Ime Lokacije',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBids()
    {
        return $this->hasMany(Bids::className(), ['loc_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrders()
    {
        return $this->hasMany(Orders::className(), ['loc_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrders0()
    {
        return $this->hasMany(Orders::className(), ['loc_id2' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPresentations()
    {
        return $this->hasMany(Presentations::className(), ['loc_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProviderLocations()
    {
        return $this->hasMany(ProviderLocations::className(), ['loc_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserDetails()
    {
        return $this->hasMany(UserDetails::className(), ['loc_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserLocations()
    {
        return $this->hasMany(UserLocations::className(), ['loc_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserObjects()
    {
        return $this->hasMany(UserObjects::className(), ['loc_id' => 'id']);
    }
}
