<?php
use yii\helpers\Html;
use yii\helpers\HtmlPurifier;
use yii\helpers\Url;
?>          
<div class="card_container teaser-650 grid-item fadeInUp animated" id="card_container" style="float:none;">
    <a href="<?= Url::to('/message-thread/'.$model->id) ?>">
        <div class="header-context">                
            <div class="avatar">
                <?= Html::img('@web/images/cards/default_avatar.jpg') ?>          
            </div>
            <div class="title">
                <div class="head second">Masterplan</div>
                <div class="subhead"><?= \yii\timeago\TimeAgo::widget(['timestamp' => date('U')]); ?></div> 
            </div>
            <div class="subaction">
                <?= \yii\timeago\TimeAgo::widget(['timestamp' => date('U')]); ?>    
            </div>
        </div>        
        <div class="secondary-context cont">
            <p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                ex ea commodo consequat.</p>
        </div>
    </a>
</div>