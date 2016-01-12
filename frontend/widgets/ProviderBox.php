<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace frontend\widgets;

use Yii;
use yii\base\Widget;
/*use yii\base\InvalidConfigException;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;*/

/**
 * ProviderBox displays the page specific stats on the right sidebar.
 *
 * To use ProviderBox, you need to configure its [[links]] property, which specifies the links to be displayed. For example,
 *
 * ~~~
 * // $this is the view object currently being used
 * echo ProviderBox::widget([
 *           
 * ]);
 * ~~~
 *
 * @author Bojan Grozdanic <bojan.grozdanic@gmail.com>
 * @since 2.0
 */
class ProviderBox extends Widget
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
