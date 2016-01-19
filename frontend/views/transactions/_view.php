<?php
use yii\helpers\Html;
use yii\helpers\HtmlPurifier;
use yii\helpers\Url;
?>          
<div class="card_container record-650 list-item" id="card_container" style="float:none;">
    <a href="<?= Url::to('/transaction/'.$model->id) ?>">
        <div class="primary-context small-margin">
            <div class="head lower">
                Transaction <?= $model->id ?>
                
                <div class="subaction">
                    <i class="fa fa-clock-o"></i> <?= \yii\timeago\TimeAgo::widget(['timestamp' => $model->time]) ?>
                </div>
            </div>
            <div class="subhead"><?= $model->agreement_id ?></div>
        </div>
        <div class="secondary-context tease">
            <?= $model->user->username ?>
        </div>
        <div class="action-area">
            <?= Html::a(Yii::t('app', 'Mark as read'), Url::to(), ['class'=>'btn btn-link']); ?>
        </div>
    </a>            
</div>