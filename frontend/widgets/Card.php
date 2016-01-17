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
use yii\helpers\Url;

/**
 * Card displays a card on the left sidebar.
 *
 * To use Card, you need to configure its [[links]] property, which specifies the links to be displayed. For example,
 *
 * ~~~
 * // $this is the view object currently being used
 * echo Card::widget([
 *     'cardPic' => $this->cardPic, // Card Picture
 *     'cardIcon'=>$this->cardIcon, // Card Icon
 *     'cardSub'=>$this->cardSub, // Card SubTitle
 *     'cardTitle'=>$this->cardTitle, // Card Title
 *     
 * ]);
 * ~~~
 *
 * @author Bojan Grozdanic <bojan.grozdanic@gmail.com>
 * @since 2.0
 */
class Card extends Widget
{
    public $cardData = [];
    public $scroller = true;

    /**
     * Renders the widget
     */
    public function run()
    {
        if($this->cardData['pic']==null){
            $this->cardData['pic'] = 'default_avatar';
        } ?>

            <div class="card_container record-200 grid-item fadeInUp animated clear-margins" id="card_container" style="float:none; clear:both;">
                <a href="<?= Url::to('/') ?>">            
                    <div class="media-area square">                
                        <div class="image">
                            <?= Html::img(Yii::$app->homeUrl.'images/cards/'.$this->cardData['pic'].'.jpg', ['alt'=>'Profile card']) ?>               
                        </div>
                        <?php if($this->scroller): ?>
                        <div class="primary-context in-media dark right">
                            <div class="head"><?php echo $this->cardData['head']; ?></div>
                            <div class="subhead"><?php echo $this->cardData['subhead']; ?></div>
                        </div>
                        <?php endif; ?>
                    </div>
                </a>
            </div>


        <?php
    }
}
