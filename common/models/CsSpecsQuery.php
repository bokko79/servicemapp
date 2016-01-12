<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[CsSpecs]].
 *
 * @see CsSpecs
 */
class CsSpecsQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return CsSpecs[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return CsSpecs|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}