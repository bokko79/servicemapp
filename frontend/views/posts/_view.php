<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\helpers\Url;
?>

<div class="card_container teaser-270 grid-item fadeInUp animated" id="card_container" style="float:none;">
    <a href="<?= Url::to('/post/'.$model->id) ?>">
        <div class="media-area">                
            <div class="image">
                <?= Html::img('@web/images/cards/info/info_docs'.rand(0, 9).'.jpg') ?>                    
            </div>
        </div>
        <div class="primary-context">
            <div class="head"><?= $model->title ?></div>
            <div class="subhead"><?= $model->postCategory->ime ?></div>
        </div>
        <div class="secondary-context cont">
            <p><?= substr($model->body, 0, 500) ?></p>
        </div>
        <div class="action-area right">
            <?= Html::a('<i class="fa fa-shopping-cart"></i>&nbsp;'.Yii::t('app', 'Read more'), Url::to(), ['class'=>'btn btn-link']); ?>
        </div>
    </a>
</div>