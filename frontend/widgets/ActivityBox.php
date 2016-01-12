<?php

namespace frontend\widgets;

use yii\helpers\ArrayHelper;
use yii\helpers\Html;

/**
 * ActivityBox widget renders a list of related articles
 * @var $items [] list of items in ListView
 * @var $limit int number of items rendered
 * @var $internalOptions [] list of DB restrictions
 */
class ActivityBox extends \yii\bootstrap\Widget
{
    public static $items = [];
    public static $html = '';
    public static $limit = 5;
    public static $internalOptions = [];

    public function init()
    {
        parent::init();
        static::$items = [];
        static::$html = '';
    }

    public static function getLastArticles($externalOptions = [])
    {
        if (count($externalOptions) && isset($externalOptions['location'])) {
            $descendants = $externalOptions['location']->getDescendants()->select('location.id')->column();;
            foreach ($descendants as $l) {
                $externalOptions['location_id'][] = $l;
            }
            $externalOptions['location_id'][] = $externalOptions['location']->id;
        }
        self::$internalOptions = ArrayHelper::merge([
            'location_id' => 0,
            'order_by' => [
                'updated_at' => SORT_DESC
            ],
            'limit' => static::$limit,
        ], $externalOptions);

        self::$items = Model::find()->location(self::$internalOptions['location_id'])
            ->orderBy(self::$internalOptions['order_by'])
            ->all();

        return self::renderItems();
    }

    protected static function renderItems()
    {
        return ListView::widget([
            'dataProvider' => new ArrayDataProvider([
                    'allModels' => self::$items,
                    'pagination' => [
                        'class' => CustomPagination::className(),
                        'pageSize' => self::$internalOptions['limit'],
                        'relatedModel' => self::$internalOptions['location'],
                        'relatedModelType' => 'location',
                    ],
                ]),
            'summary' => false,
            'itemOptions' => ['class' => 'item'],
            'itemView' => function ($model, $key, $index, $widget) {
                    return Html::a($model->title, ArrayHelper::getValue($model->getLinks(), 'frontend'));
                },
        ]);
    }
}