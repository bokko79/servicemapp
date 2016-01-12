<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[CsActionsTranslation]].
 *
 * @see CsActionsTranslation
 */
class CsActionsTranslationQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return CsActionsTranslation[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return CsActionsTranslation|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}