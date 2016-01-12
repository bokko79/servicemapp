<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[CsObjectIssuesTranslation]].
 *
 * @see CsObjectIssuesTranslation
 */
class CsObjectIssuesTranslationQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return CsObjectIssuesTranslation[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return CsObjectIssuesTranslation|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}