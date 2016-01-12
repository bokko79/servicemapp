<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[CsUnitsTranslation]].
 *
 * @see CsUnitsTranslation
 */
class CsUnitsTranslationQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return CsUnitsTranslation[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return CsUnitsTranslation|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}