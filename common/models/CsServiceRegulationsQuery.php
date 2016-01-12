<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[CsServiceRegulations]].
 *
 * @see CsServiceRegulations
 */
class CsServiceRegulationsQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return CsServiceRegulations[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return CsServiceRegulations|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}