<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[CsObjectsTranslation]].
 *
 * @see CsObjectsTranslation
 */
class CsObjectsTranslationQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return CsObjectsTranslation[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return CsObjectsTranslation|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}