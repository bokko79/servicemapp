<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[UserNotifications]].
 *
 * @see UserNotifications
 */
class UserNotificationsQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return UserNotifications[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return UserNotifications|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}