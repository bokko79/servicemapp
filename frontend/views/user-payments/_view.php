<?php
use yii\helpers\Html;
use yii\helpers\HtmlPurifier;
use yii\helpers\Url;
use yii\helpers\StringHelper;
?>       
<div class="card_container record-650 list-item" id="card_container" style="float:none;">
    <div class="primary-context">
        <div class="head lower">
            <i class="fa fa-credit-card"></i> <?= $model->payment_type ?>
            <div class="action-area">
                <?= Html::a('<i class="fa fa-pencil"></i>', Url::to('/payment-setup/'.$model->id), ['class'=>'btn btn-default']); ?>
                <?= Html::a('<i class="fa fa-times"></i>', Url::to(), ['class'=>'btn btn-danger']); ?>
            </div>
        </div>
        <div class="subhead"><?= StringHelper::truncate($model->card_no, 8 , '...') ?> | <?= $model->status ?></div>
    </div>        
</div>