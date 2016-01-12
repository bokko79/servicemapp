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
 * Stats displays the page specific stats on the right sidebar.
 *
 * To use Stats, you need to configure its [[links]] property, which specifies the links to be displayed. For example,
 *
 * ~~~
 * // $this is the view object currently being used
 * echo Stats::widget([
 *           
 * ]);
 * ~~~
 *
 * @author Bojan Grozdanic <bojan.grozdanic@gmail.com>
 * @since 2.0
 */
class Stats extends Widget
{
    public $boxData=array();


    /**
     * Renders the widget
     */
    public function run()
    {
        if(count($this->boxData))
        {
            echo '<div class="upper_stat_container"">';

                foreach($this->boxData as $key=>$box)
                {   
                    echo '<table class="stat_box_cont" style="'.(($key==2) ? 'margin-right:0' : '').'">';                       

                            echo '<tr><td class="title">'.$box['title'].'</td></tr>';
                            echo '<tr><td class="stat_box">';
                                echo '<table>';
                                echo '<tr><td class="main_data" colspan="2">'.$box['value'].'</td></tr>';                               
                                echo '<tr class="spaceUnder"><td colspan="2"></td></tr>';
                                echo '<tr><td class="perc" style="color:#9DD3AF; border-right: 1px solid #ddd;">'.$box['sub'].'</td><td class="perc">'.$box['perc'].'%</td></tr></table>';                      
                   
                    echo '</td></tr></table>';
                }           

            echo '</div>';
        }
    }
}
