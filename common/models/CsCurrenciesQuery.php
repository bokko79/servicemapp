<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[CsCurrencies]].
 *
 * @see CsCurrencies
 */
class CsCurrenciesQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return CsCurrencies[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return CsCurrencies|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}