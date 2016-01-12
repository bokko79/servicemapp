<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[CsSectorsTranslation]].
 *
 * @see CsSectorsTranslation
 */
class CsSectorsTranslationQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return CsSectorsTranslation[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return CsSectorsTranslation|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}