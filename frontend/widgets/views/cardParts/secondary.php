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
<?= ($upperContainer) ? $upperContainerContent : null ?>
<div class="secondary-context <?= $class ?>" id=" <?= $id ?>"  style=" <?= $style ?>">
    <?php if($version==1): ?>
    	<?= $content ?>
    <?php if($version==2): ?>
    	<div class="float-left" style="">
            <div class="avatar center gray-color">
                <i class="fa fa-<?= $avatarIcon ?> fa-3x"></i>    
            </div>
            <div class="title">
                <div class="subhead <?= $subhead ?>"><?= $subheadContent ?></div> 
                <div class="head <?= $head ?>"><?= $headContent ?></div>
                <span class="strikethrough"><?= $strikethrough ?></span> <span class="label label-warning"><?= $labeledContent ?></span>
            </div>
        </div>
        <div class="action-area <?= $action ?>" style="">
            <?= $actionContent ?>
        </div>
    <?php if($version==3): ?>


    <?php endif; ?>

</div>
<?= ($hr) ? '<hr class="no-margin">' : null ?>
<?= ($lowerContainer) ? '</div>' : null ?>