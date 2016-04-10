<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[CsServiceObjectModels]].
 *
 * @see CsServiceObjectModels
 */
class CsServiceObjectModelsQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return CsServiceObjectModels[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return CsServiceObjectModels|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
