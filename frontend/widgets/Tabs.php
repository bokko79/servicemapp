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
 * Tabs displays a card on the left sidebar.
 *
 * To use Tabs, you need to configure its [[links]] property, which specifies the links to be displayed. For example,
 *
 * ~~~
 * // $this is the view object currently being used
 * echo Tabs::widget([
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
class Tabs extends Widget
{
    public $tabs=array();

    /**
     * Renders the widget
     */
    public function run()
    {
        if(empty($this->tabs))
            return; 
        
       
        if($this->tabs)
        {
            echo '<div class="title_track">';
            echo '<ul class="navpro-tabs" role="tablist">';

                $non_empty_tabs = array();

                foreach($this->tabs as $tabb)
                {
                    if ($tabb!=null)
                        $non_empty_tabs[] = $tabb;
                }

                foreach($non_empty_tabs as $key=>$tab)
                {

                    if ($key<5):
                        echo '<li class="'.(($tab['active']/* && Yii::$app->urlManager->parseUrl(Yii::$app->request)==$tab['active']*/) ? 'active' : '').'">';
                            echo '<a href="'.$tab['url'].'"  class="'.$tab['class'].'" '.$tab['role'].'>';
                                echo '<i class="fa '.$tab['icon'].'"></i>&nbsp;';
                                echo $tab['label'];
                            echo '</a>';
                        echo '</li>';
                    endif;
                }

            

                if(count($non_empty_tabs)>5)
                {
                    echo '<li class="dropdown"><a href="#" onclick="return false">'.Yii::t('main', 'Još').'&nbsp;<i class="fa fa-caret-down"></i></a><ul class="">';

                        foreach($non_empty_tabs as $key=>$tab)
                        {
                            if ($key>4):
                                echo '<li class="'.(($tab['active']/* && Yii::$app->urlManager->parseUrl(Yii::$app->request)==$tab['active']*/) ? 'active' : '').'">';
                                    echo '<a href="'.$tab['url'].'"  class="'.$tab['class'].'" '.$tab['role'].'>';
                                        echo '<i class="fa '.$tab['icon'].'"></i>&nbsp;';
                                        echo $tab['label'];
                                    echo '</a>';
                                echo '</li>';
                            endif;
                        }

                    echo '</ul></li>';
                }

            echo '</ul>';
            echo '</div>';

        } //    if($this->tabs) 
    }
}
