<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[CsIndustries]].
 *
 * @see CsIndustries
 */
class CsIndustriesQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return CsIndustries[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return CsIndustries|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}