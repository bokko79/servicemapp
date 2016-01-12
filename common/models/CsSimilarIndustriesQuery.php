<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[CsSimilarIndustries]].
 *
 * @see CsSimilarIndustries
 */
class CsSimilarIndustriesQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return CsSimilarIndustries[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return CsSimilarIndustries|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}