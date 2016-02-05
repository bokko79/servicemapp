<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

use yii\helpers\Url;
use yii\helpers\Html;

?>
<div class="comment-wrap <?= $class ?>">
    <table>
        <tr>
            <td class="avatar"><?= Html::img('@web/images/cards/'.$comment->user->avatar->ime) ?></td>
            <td class="body">
                <table>
                    <tr><td class="head second"><?= $comment->user->username ?> <p style="float-left"><?= $comment->text ?></p></td></tr>
                    <tr><td class="gray-color fs_12"><i class="fa fa-clock-o"></i> <?= \yii\timeago\TimeAgo::widget(['timestamp' => $comment->update_time]) ?></td></tr>
                </table>
            </td>
        </tr>                        
    </table>
</div>