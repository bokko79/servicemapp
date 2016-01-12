<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[Notifications]].
 *
 * @see Notifications
 */
class NotificationsQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return Notifications[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Notifications|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}