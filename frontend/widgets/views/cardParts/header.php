<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace frontend\widgets;

use Yii;
use yii\helpers\Url;
use yii\helpers\Html;
?>

<div class="header-context <?= $class ?>">    
    <div class="avatar <?= $avatar ?>">
    <?php switch ($version) {
        case 2:
            echo '<i class="fa fa-'.$avatarIcon.' fa-3x"></i>';
            break;
        
        default:
            echo Html::img('@web/images/cards/'.$model->user->avatar->ime);
            break;
    } ?>
    </div>
    <div class="title">
        <div class="head <?= $head ?>">
        <?php if($version==1) {
                echo $model->user->username;
            } elseif ($version==2) {
                echo $headContent;
            } ?>
        </div>
        <div class="<?= $subhead ?>">
        <?php if($version==1) {
                echo $model->user->location->city;
            } elseif ($version==2) {
                echo $subheadContent;
            } ?>
        </div> 
    </div>       
    <div class="right <?= $subaction ?>">
        <?php if($version==1) {
                echo '<i class="fa fa-clock-o"></i> '. \yii\timeago\TimeAgo::widget(['timestamp' => $model->update_time]);
            } elseif ($version==2) {
                echo $subactionContent;
            } ?> 
    </div>    
</div>
<?= ($hr) ? '<hr class="no-margin">' : null ?>