<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "user_details".
 *
 * @property string $user_id
 * @property string $loc_id
 * @property string $image_id
 * @property string $lang_code
 * @property integer $currency_id
 * @property integer $role_id
 * @property string $time_role_set
 * @property string $time_role_exp
 * @property string $Mcoin
 * @property integer $units
 * @property string $timezone
 * @property integer $ticker_status
 * @property string $DOB
 * @property string $gender
 * @property integer $score
 * @property integer $rate
 * @property integer $rating
 * @property string $update_time
 *
 * @property Roles $role
 * @property CsLanguages $langCode
 * @property Images $image
 * @property Locations $loc
 * @property CsCurrencies $currency
 * @property User $user
 */
class UserDetails extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user_details';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'loc_id', 'time_role_set'], 'required'],
            [['user_id', 'loc_id', 'image_id', 'currency_id', 'role_id', 'Mcoin', 'units', 'ticker_status', 'score', 'rate', 'rating'], 'integer'],
            [['time_role_set', 'time_role_exp', 'DOB', 'update_time'], 'safe'],
            [['timezone', 'gender'], 'string'],
            [['lang_code'], 'string', 'max' => 2]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'user_id' => Yii::t('app', 'User ID'),
            'loc_id' => Yii::t('app', 'Loc ID'),
            'image_id' => Yii::t('app', 'Image ID'),
            'lang_code' => Yii::t('app', 'Lang Code'),
            'currency_id' => Yii::t('app', 'Currency ID'),
            'role_id' => Yii::t('app', 'Role ID'),
            'time_role_set' => Yii::t('app', 'Time Role Set'),
            'time_role_exp' => Yii::t('app', 'Time Role Exp'),
            'Mcoin' => Yii::t('app', 'Mcoin'),
            'units' => Yii::t('app', 'Units'),
            'timezone' => Yii::t('app', 'Timezone'),
            'ticker_status' => Yii::t('app', 'Ticker Status'),
            'DOB' => Yii::t('app', 'Dob'),
            'gender' => Yii::t('app', 'Gender'),
            'score' => Yii::t('app', 'Score'),
            'rate' => Yii::t('app', 'Rate'),
            'rating' => Yii::t('app', 'Rating'),
            'update_time' => Yii::t('app', 'Update Time'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRole()
    {
        return $this->hasOne(Roles::className(), ['id' => 'role_id']);
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
    public function getImage()
    {
        return $this->hasOne(Images::className(), ['id' => 'image_id']);
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
    public function getCurrency()
    {
        return $this->hasOne(CsCurrencies::className(), ['id' => 'currency_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
