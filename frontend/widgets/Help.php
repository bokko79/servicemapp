<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace frontend\widgets;

use Yii;
use yii\base\Widget;
use yii\base\InvalidConfigException;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

/**
 * Help displays a card on the left sidebar.
 *
 * To use Help, you need to configure its [[links]] property, which specifies the links to be displayed. For example,
 *
 * ~~~
 * // $this is the view object currently being used
 * echo Help::widget([
 *     
 * ]);
 * ~~~
 *
 * @author Bojan Grozdanic <bojan.grozdanic@gmail.com>
 * @since 2.0
 */
class Help extends Widget
{
    public $help=array();


    /**
     * Renders the widget
     */
    public function run()
    {
        return true;
    }
}
