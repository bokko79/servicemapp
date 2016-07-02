<?php

namespace common\models;

use Yii;
use dosamigos\google\maps\LatLng;
use dosamigos\google\maps\overlays\InfoWindow;
use dosamigos\google\maps\overlays\Marker;
use dosamigos\google\maps\Map;
use dosamigos\google\maps\overlays\Circle;
/**
 * This is the model class for table "locations".
 *
 * @property string $id
 * @property integer $is_fav
 * @property string $user_id
 * @property integer $def
 * @property string $name
 * @property string $country
 * @property string $state
 * @property string $district
 * @property string $city
 * @property string $zip
 * @property string $mz
 * @property string $street
 * @property string $no
 * @property integer $floor
 * @property integer $apt
 * @property string $lat
 * @property string $lng
 * @property string $location_name
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
    public $control;
    public $userControl;

    /*const SCENARIO_DEFAULT = 'default';
    const SCENARIO_REGISTER = 'register';
    const SCENARIO_ORDER = 'order';
    const SCENARIO_PRESENTATION = 'presentation'; */

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
            [['is_fav', 'user_id', 'def', 'zip', 'floor', 'apt'], 'integer'],
            //[['user_id'], 'required'],
            //[['lat', 'lng'], 'required', 'message'=>'Nepravilno uneta lokacija.'],
            [['lat', 'lng'], 'number'],
            [['name'], 'safe'],
            [['country', 'state', 'district', 'city', 'mz', 'street'], 'string', 'max' => 64],
            [['no'], 'string', 'max' => 4],
            [['buzzer'], 'string', 'max' => 32],
            [['location_name'], 'string', 'max' => 128],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /*public function scenarios()
    {
        return [
            self::SCENARIO_PRESENTATION => ['location_name', 'zip', 'floor', 'apt', 'no', 'name', 'lat', 'lng', 'city', 'country', 'state', 'district', 'mz', 'street'],
            self::SCENARIO_REGISTER => ['location_name', 'zip', 'floor', 'apt', 'no', 'name', 'lat', 'lng', 'city', 'country', 'state', 'district', 'mz', 'street'],
            self::SCENARIO_DEFAULT => ['location_name', 'zip', 'floor', 'apt', 'no', 'name', 'lat', 'lng', 'city', 'country', 'state', 'district', 'mz', 'street'],

        ];
    }*/

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
            'name' => 'Lokacija',
            'country' => 'Country',
            'state' => 'State',
            'district' => 'District',
            'city' => 'City',
            'zip' => 'Zip',
            'mz' => 'Mz',
            'street' => 'Ulica',
            'no' => 'Broj',
            'floor' => 'Sprat',
            'apt' => 'Stan',
            'buzzer' => 'Interfon',
            'lat' => 'Lat',
            'lng' => 'Lng',
            'location_name' => 'Ime Lokacije',
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

    public function map($width = 400, $height = 420, $lw = null, $m = true)
    {        
        $coord = new LatLng(['lat' => $this->lat, 'lng' => $this->lng]);
        $map = new Map([
            'center' => $coord,
            'zoom' => $this->mapZoom($lw),    
        ]);

        $map->width = $width;
        $map->height = $height;

        if($m){
            // Lets add a marker now
            $marker = new Marker([
                'position' => $coord,
                'title' => 'Mesto gde vršimo uslugu',
            ]);

            // Add marker to the map
            $map->addOverlay($marker);
        }            

        if($lw){
            // Lets add a marker now
            $circle = new Circle([
                'center' => $coord,
                'radius' => $lw*1000,
                /*'strokeWeight' => '5px',
                'strokeOpacity' => .0,*/
                'strokeColor' => '#2196F3',
                'strokeWeight' => 1,
                'fillOpacity' => 0.08,
                //'editable' => true,
            ]);
            $map->addOverlay($circle);
        }
        return $map;        
    }

    public function mapZoom($lw)
    {
        if($w = $lw){
            if($w<1){return 14;}
            else if($w>=1 && $w<3){return 13;}
            else if($w>=3 && $w<6){return 12;}
            else if($w>=6 && $w<11){return 11;}
            else if($w>=11 && $w<22){return 10;}
            else if($w>=22 && $w<45){return 9;}  
            else if($w>=45 && $w<90){return 8;}
            else if($w>=90 && $w<180){return 7;}
            else if($w>=180 && $w<300){return 6;}
            else if($w>=300){return 5;}
        } else {
            return 14;
        }
    }

    public function getCityLocation()
    {        
        return ($this->city && $this->country) ? $this->city . ', ' .$this->country : null;
    }

    public function getStreetLocation()
    {        
        return $this->street . ', ' . $this->city . ', ' . $this->country;
    }

    public function distanceTo(Locations $location_to)
    {        
        return round(distance($this->lat, $this->lng, $location_to->lat, $location_to->lng), 2);
    }
}
