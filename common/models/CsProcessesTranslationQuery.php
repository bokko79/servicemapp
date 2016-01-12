<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[CsProcessesTranslation]].
 *
 * @see CsProcessesTranslation
 */
class CsProcessesTranslationQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return CsProcessesTranslation[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return CsProcessesTranslation|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}