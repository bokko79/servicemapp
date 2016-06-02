<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[CsPropertyValuesTranslation]].
 *
 * @see CsPropertyValuesTranslation
 */
class CsPropertyValuesTranslationQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return CsPropertyValuesTranslation[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return CsPropertyValuesTranslation|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
