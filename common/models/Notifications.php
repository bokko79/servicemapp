<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "notifications".
 *
 * @property string $id
 * @property string $user_id
 * @property string $code
 * @property string $alias
 * @property string $alias2
 * @property string $body
 * @property integer $is_read
 * @property string $notification_time
 *
 * @property User $user
 */
class Notifications extends \yii\db\ActiveRecord
{
    public $cc;
    public $_notification;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'notifications';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'code', 'notification_time'], 'required'],
            [['user_id', 'alias', 'is_read', 'cc'], 'integer'],
            [['code', 'body'], 'string'],
            [['notification_time'], 'safe'],
            [['alias2'], 'string', 'max' => 20]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'Korisnik.',
            'code' => 'Kod notifikacije.',
            'alias' => 'Pomoćni alias za notifikaciju.',
            'alias2' => 'Pomoćni alias2 za notifikaciju.',
            'body' => 'Tekst notifikacije.',
            'is_read' => 'Korisnik je pročitao notifikaciju. 0 - nije; 1 - jeste.',
            'notification_time' => 'Datum i vreme notifikacije.',
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
     * @return NotificationsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new NotificationsQuery(get_called_class());
    }

    /*public function getNotification()
    {
        return $this->_notification;
    }

    public function setNotification($value)
    {
        $this->_notification = trim($value);
    }*/

   
    public function notifyText()
    {
        switch ($this->code) {
            case 'upd_memb':
                $usert = \frontend\models\User::find()->where(['id'=>$this->alias]);
                $icon = '<i class="fa fa-cog fa-lg"></i>';
                $color = 'red';
                $notify_title = Yii::t('app', 'Membership Updated');
                $notify_text = Yii::t('app', 'Your membership has been successfully updated to: <b>{alias}</b>.'/*, array('{alias}'=>$usert->username)*/);
                break;
            
            default:
                $icon = '<i class="fa fa-cogs fa-lg"></i>';
                $color = 'green';
                $notify_title = Yii::t('app', 'Membership Updated');
                $notify_text = Yii::t('app', 'Your membership has been successfully updated to: <b>{alias}</b>.');
                break;
        }

        $this->_notification = [
            'icon' => $icon,
            'color' => $color,
            'notify_title' => $notify_title,
            'notify_text' => $notify_text,
        ];

        if($this->_notification) {
            return $this->_notification;
        } else {
            return false;
        }
    }
}
