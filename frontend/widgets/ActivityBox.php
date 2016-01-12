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
    public $boxData=array();


    /**
     * Renders the widget
     */
    public function run()
    {
        return true;
    }
}