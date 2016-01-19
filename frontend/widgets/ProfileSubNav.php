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
 * ProfileSubNav displays a card on the left sidebar.
 *
 * To use ProfileSubNav, you need to configure its [[links]] property, which specifies the links to be displayed. For example,
 *
 * ~~~
 * // $this is the view object currently being used
 * echo ProfileSubNav::widget([
 *     
 * ]);
 * ~~~
 *
 * @author Bojan Grozdanic <bojan.grozdanic@gmail.com>
 * @since 2.0
 */
class ProfileSubNav extends Widget
{
    public $profileSubNavData= [];

    /**
     * Renders the widget
     */
    public function run()
    { ?>
        <div class="grid-row">
            <div class="grid-left avatar" style="">
                <?= Html::img(Yii::$app->homeUrl.'images/cards/'.$this->profileSubNavData['pic'].'.jpg', ['alt'=>'Profile card']) ?>
            </div>
            <div class="grid-center">
                <?php echo '<h1>'.$this->profileSubNavData['title'].'</h1>';  ?>
                <?php
                    echo '<div class="general">';
                        echo '<span><b>@'.$this->profileSubNavData['username'].'</b>&nbsp;|&nbsp;'.$this->profileSubNavData['loc'].'</span>';
                    echo '</div>'; ?>
            </div>
            <div class="grid-right ">                    
            </div>
        </div>
<?php
    }
}
