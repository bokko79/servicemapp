<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[CsPropertyModels]].
 *
 * @see CsPropertyModels
 */
class CsPropertyModelsQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return CsPropertyModels[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return CsPropertyModels|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}