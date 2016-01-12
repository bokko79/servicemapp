<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[UserServices]].
 *
 * @see UserServices
 */
class UserServicesQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return UserServices[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return UserServices|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}