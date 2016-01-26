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
<div class="comment-wrap <?= $class ?>">
    <table>
        <tr>
            <td class="avatar"><?= Html::img('@web/images/cards/'.$comment->user->avatar->ime) ?></td>
            <td class="body">
                <table>
                    <tr>
                        <td class="head second"><?= $comment->user->username ?></td>
                        <td class="subaction"><i class="fa fa-clock-o"></i> <?= \yii\timeago\TimeAgo::widget(['timestamp' => $comment->update_time]) ?></td>                       
                    </tr>
                </table>
                <p><?= $comment->text ?></p> 
            </td>
        </tr>                        
    </table>
</div>