<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace frontend\widgets;

use Yii;
use yii\base\InvalidConfigException;
use yii\base\Widget;
use yii\data\Sort;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;

/**
 * LinkSorter renders a list of sort links for the given sort definition.
 *
 * LinkSorter will generate a hyperlink for every attribute declared in [[sort]].
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class IndexSorter extends \yii\widgets\LinkSorter
{
    /**
     * Renders the sort links.
     * @return string the rendering result
     */
    protected function renderSortLinks()
    {
        $attributes = empty($this->attributes) ? array_keys($this->sort->attributes) : $this->attributes;
        $links = [];
        foreach ($attributes as $key=>$name) {
            $links[$name] = $name;
        }
        echo Html::beginForm(null, 'get', []);
        echo Html::dropDownList('sort', null, $links, ['prompt'=>'Sortiraj po']);
        echo Html::submitButton('<i class="fa fa-sort"></i>', ['class' => 'btn btn-default margin-left-5']);
        echo Html::endForm();
    }
}
