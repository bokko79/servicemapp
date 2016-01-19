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
 * PageTitle displays a card on the left sidebar.
 *
 * To use PageTitle, you need to configure its [[links]] property, which specifies the links to be displayed. For example,
 *
 * ~~~
 * // $this is the view object currently being used
 * echo PageTitle::widget([
 *     
 * ]);
 * ~~~
 *
 * @author Bojan Grozdanic <bojan.grozdanic@gmail.com>
 * @since 2.0
 */
class PageTitle extends Widget
{
    public $titleData=array();

    /**
     * Renders the widget
     */
    public function run()
    {
        echo '<div class="title_holder_home" style="">';
            echo '<h1 style="margin-top:0;"><table><tr><td class="icon"><i class="fa fa-'.$this->titleData['icon'].'"></i></td>';
            echo '<td>'.$this->titleData['title'].'</td></tr></table></h1>';
            echo $this->titleData['description'];

            if ($this->titleData['search']!=null) {
                echo $this->render('/'.Yii::$app->controller->id.'/_search.php', ['model'=>$this->titleData['search']]);
            }
        echo '</div>';
    }
}
