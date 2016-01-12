<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "orders".
 *
 * @property string $id
 * @property string $activity_id
 * @property string $loc_id
 * @property string $loc_id2
 * @property integer $loc_within
 * @property string $delivery_starts
 * @property string $delivery_ends
 * @property string $validity
 * @property string $update_time
 * @property string $lang_code
 * @property string $class
 * @property string $registered_to
 * @property integer $phone_contact
 * @property integer $turn_key
 * @property string $order_type
 * @property integer $process_id
 * @property integer $success
 * @property string $success_time
 * @property string $hit_counter
 *
 * @property Bids[] $bids
 * @property OrderServices[] $orderServices
 * @property Locations $loc
 * @property Locations $locId2
 * @property CsLanguages $langCode
 * @property CsProcesses $process
 * @property Provider $registeredTo
 */
class Orders extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'orders';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['activity_id'], 'required'],
            [['activity_id', 'loc_id', 'loc_id2', 'loc_within', 'registered_to', 'phone_contact', 'turn_key', 'process_id', 'success', 'hit_counter'], 'integer'],
            [['delivery_starts', 'delivery_ends', 'validity', 'update_time', 'success_time'], 'safe'],
            [['class', 'order_type'], 'string'],
            [['lang_code'], 'string', 'max' => 2]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'activity_id' => 'ID Stavke.',
            'loc_id' => 'Lokacija pošiljaoca zahteva, na kojoj se odvija izvršenje usluge.',
            'loc_id2' => 'Lokacija na kojoj se završava izvršenje usluge.',
            'loc_within' => 'Lokacija u okviru kilometara.',
            'delivery_starts' => 'Vreme kada je predviđen početak izvršenja usluge.',
            'delivery_ends' => 'Vreme do kada se očekuje izvršenje usluge.',
            'validity' => 'Vreme do kada je stavka aktivna.',
            'update_time' => 'Datum i vreme izmene zahteva.',
            'lang_code' => 'Jezik zahteva.',
            'class' => 'Vrsta zahteva: \'global\' - Zahtev poslat na aukciju; \'registered\' - Preporučen zahtev.',
            'registered_to' => 'Kojem pružaocu usluge je zahtev namenjen.',
            'phone_contact' => 'Dozvola da se pošiljalac kontaktira putem telefona od strane pobedničkog pružaoca usluge. 0 - ne; 1 - da.',
            'turn_key' => 'Zahtev podrazumeva ključ u ruke, tj ponudu i za ruke i za materijal/alat. 0 - ne; 1 - da.',
            'order_type' => 'Vrsta zahteva za uslugu na osnovu usluga koje sadrži. single - sadrži jednu uslugu; multi - sadrži više usluge iz iste delatnosti; operation - sadrži usluge sa istim predmetom usluge; process - sadrži usluge procesa.',
            'process_id' => 'Uslužni proces koji je obuhvaćen zahtevom.',
            'success' => 'Zahtev je uspešan. 0 - ne; 1 - da.',
            'success_time' => 'Datum i vreme uspešnosti zahteva za uslugu.',
            'hit_counter' => 'Broj pregleda zahteva za uslugu.',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBids()
    {
        return $this->hasMany(Bids::className(), ['order_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrderServices()
    {
        return $this->hasMany(OrderServices::className(), ['order_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLoc()
    {
        return $this->hasOne(Locations::className(), ['id' => 'loc_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLocId2()
    {
        return $this->hasOne(Locations::className(), ['id' => 'loc_id2']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLangCode()
    {
        return $this->hasOne(CsLanguages::className(), ['code' => 'lang_code']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProcess()
    {
        return $this->hasOne(CsProcesses::className(), ['id' => 'process_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRegisteredTo()
    {
        return $this->hasOne(Provider::className(), ['id' => 'registered_to']);
    }

    /**
     * @inheritdoc
     * @return OrdersQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new OrdersQuery(get_called_class());
    }
}
