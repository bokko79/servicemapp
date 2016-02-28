<?php
/* @var $this yii\web\View */
/* @var $model frontend\models\Orders */
use yii\helpers\Html;
use yii\helpers\Url;
?>
<div class="card_container record-full" id="card_container" style="float:none;">   

     <?php /* price/action */ ?>
    <div class="secondary-context" style="height:84px;">
        <div class="float-left" style="">
            <div class="avatar center gray-color">
                <i class="fa fa-barcode fa-3x"></i>    
            </div>
            <div class="title">
                <div class="subhead"><?= Yii::t('app', 'cena') ?></div> 
                <div class="head black no-padding"><?= Yii::$app->formatter->asCurrency(12750, 'EUR') ?></div>
                <span class="strikethrough"><?= Yii::$app->formatter->asCurrency(13499.99, 'EUR') ?></span> <span class="label label-warning">popust 25%</span>
            </div>
        </div>
        <div class="float-right action-area no-margin no-padding" style="">
            <div class="head second padding-bottom-5 right gray-color">
                <?= \russ666\widgets\Countdown::widget([
                    'datetime' => $model->validity,
                    'format' => '%d<span class=\"fs_11\">'.Yii::t('app', 'd').'</span> %H<span class=\"fs_11\">h</span> %M<span class=\"fs_11\">m</span> %S<span class=\"fs_11\">s</span>',
                    'events' => [
                        //'finish' => 'function(){location.reload()}',
                    ],
                ]) ?>
            </div>
            <?= Html::a('<i class="fa fa-eye"></i>&nbsp;'.Yii::t('app', 'Prati'), Url::to(), ['class'=>'btn btn-link']); ?>
            <?= Html::a('<i class="fa fa-sticky-note"></i>&nbsp;'.Yii::t('app', 'Pošalji ponudu'), Url::to(), ['class'=>'btn btn-danger no-margin']); ?>
                    
        </div>                     
    </div>                                                             
</div>