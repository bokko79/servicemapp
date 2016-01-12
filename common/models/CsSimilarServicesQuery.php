<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[CsSimilarServices]].
 *
 * @see CsSimilarServices
 */
class CsSimilarServicesQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return CsSimilarServices[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return CsSimilarServices|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}