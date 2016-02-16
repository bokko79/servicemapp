<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[CsPropertiesTranslation]].
 *
 * @see CsPropertiesTranslation
 */
class CsPropertiesTranslationQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[lang_code]]='.Yii::$app->user->language);
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return CsPropertiesTranslation[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return CsPropertiesTranslation|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}