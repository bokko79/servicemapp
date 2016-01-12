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
        }
        echo Html::img(Yii::$app->homeUrl.'images/cards/'.$this->cardData['pic'].'.jpg', ['alt'=>'Profile card', 'class'=>'card-image', 'style'=>'', 'width'=>200]);?>        

        <?php
            if($this->scroller): ?>
            
            <div class="scroll_card fadeIn animated">       
                <span class="category_name">
                    <span class="sub"><?php echo $this->cardData['subSection']; ?></span>
                    <span class="head_user"><?php echo $this->cardData['headSection']; ?></span>
                </span>
            </div>
            <div class="card scroller_fix fadeIn animated">                 
                <div id="user_display" style="position: relative;">
                    <div id="upper_category_filter_display">
                            
                            <span class="first">
                                <?php echo $this->cardData['icon']; ?>
                            </span>                 
                            <span class="second">                           
                                <span class="category_name">
                                    <span class="sub"><?php echo $this->cardData['subtitle']; ?></span>
                                    <span class="head_user"><?php echo $this->cardData['title']; ?></span>
                                </span>
                            </span>
                            
                    </div>
                </div>  
            </div> <!-- KRAJ card -->
        <?php endif; ?>


        <?php
    }
}
