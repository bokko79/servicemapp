<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[CsLanguages]].
 *
 * @see CsLanguages
 */
class CsLanguagesQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return CsLanguages[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return CsLanguages|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}