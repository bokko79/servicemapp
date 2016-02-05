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
<div class="header-context <?= $class ?>">
    <?php if($avatar || $avatarIcon): ?>
        <div class="avatar <?= $avatar ?>">
        <?php switch ($version) {
            case 2:
                echo '<i class="fa fa-'.$avatarIcon.' fa-3x"></i>';
                break;        
            default:
                echo Html::img('@web/images/cards/'.$avatar, []);
                break;
            } ?>
        </div>
    <?php endif; ?>
    <div class="title <?= $titleClass ?><?= ($avatar || $avatarIcon) ?  null : 'no-padding' ?>">    
        <?php if($prehead): ?>
            <div class="prehead <?= $preheadClass ?>">
                <?= $prehead ?>
            </div>
        <?php endif; ?>
        <div class="head <?= $headClass ?>">
            <?= $head ?>
        </div>
        <?php if($subhead): ?>
            <div class="subhead <?= $subheadClass ?>">
                <?= $subhead ?>
            </div>
        <?php endif; ?>
        <?php if($subhead2): ?>
            <div class="subhead <?= $subhead2Class ?>">
                <?= $subhead2 ?>
            </div>
        <?php endif; ?>
    </div>
    <?php if($subaction): ?>
        <div class="<?= $subactionClass ?>">
            <?= $subaction ?>
        </div>
    <?php endif; ?> 
</div>
<?= ($hr) ? '<hr class="no-margin">' : null ?>
<?= ($lowerContainer) ? '</div>' : null ?>