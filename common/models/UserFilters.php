<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "user_filters".
 *
 * @property string $user_id
 * @property integer $kat
 * @property integer $del
 * @property integer $act
 * @property string $loc_country
 * @property string $loc_state
 * @property string $loc
 * @property integer $status
 * @property integer $time
 * @property integer $deadline
 * @property integer $ratingmin
 * @property integer $ratingmax
 * @property integer $prate
 * @property integer $urate
 * @property string $language
 * @property integer $lang
 * @property string $update_time
 *
 * @property User $user
 */
class UserFilters extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user_filters';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id'], 'required'],
            [['user_id', 'kat', 'del', 'act', 'loc_country', 'loc_state', 'loc', 'status', 'time', 'deadline', 'ratingmin', 'ratingmax', 'prate', 'urate', 'lang'], 'integer'],
            [['update_time'], 'safe'],
            [['language'], 'string', 'max' => 13]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'user_id' => 'Korisnik.',
            'kat' => 'Filter kategorije usluga.',
            'del' => 'Filter uslužne delatnosti.',
            'act' => 'Filter akcije usluge.',
            'loc_country' => 'Filter države.',
            'loc_state' => 'Filter regiona.',
            'loc' => 'Filter grada.',
            'status' => 'Filter statusa zahteva za uslugu.',
            'time' => 'Filter vremena postavke zahteva za uslugu.',
            'deadline' => 'Filter vremena do kada važi zahtev za uslugu.',
            'ratingmin' => 'Filter minimalnog rejtinga pružaoca usluge.',
            'ratingmax' => 'Filter maksimalnog rejtinga pružaoca usluge.',
            'prate' => 'Filter ocene pružaoca usluge.',
            'urate' => 'Filter ocene korisnika.',
            'language' => 'Filter jezika.',
            'lang' => 'Filter jezika.',
            'update_time' => 'Datum i vreme izmene filtera.',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * @inheritdoc
     * @return UserFiltersQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new UserFiltersQuery(get_called_class());
    }
}
