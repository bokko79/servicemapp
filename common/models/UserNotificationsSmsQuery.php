<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[UserNotificationsSms]].
 *
 * @see UserNotificationsSms
 */
class UserNotificationsSmsQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return UserNotificationsSms[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return UserNotificationsSms|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}