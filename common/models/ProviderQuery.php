<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[Provider]].
 *
 * @see Provider
 */
class ProviderQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return Provider[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Provider|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}