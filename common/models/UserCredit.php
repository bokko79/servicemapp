<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "user_credit".
 *
 * @property integer $user_id
 * @property string $balance
 * @property string $difference
 * @property string $time
 */
class UserCredit extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user_credit';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'time'], 'required'],
            [['user_id'], 'integer'],
            [['balance', 'difference'], 'number'],
            [['time'], 'safe'],
            [['user_id'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'user_id' => Yii::t('app', 'User ID'),
            'balance' => Yii::t('app', 'Balance'),
            'difference' => Yii::t('app', 'Difference'),
            'time' => Yii::t('app', 'Time'),
        ];
    }
}
