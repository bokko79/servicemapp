<?php
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\Modal;

?>
<div class="card_container record-full grid-item no-shadow top-bordered fadeIn animated" style="margin:0">
    <div class="header-context">                
        <div class="avatar">
            <?= Html::img('@web/images/cards/info/info_docs'.rand(0,9).'.jpg') ?>         
        </div>
        <div class="title">
            <div class="head major regular"><?= Html::a(c($model->title), Url::to('/presentation/'.$model->id), []); ?></div>
            <div class="subhead">
                <?= c($model->pService->tName) ?> | 
                <?= Html::a('<i class="fa fa-flag"></i>&nbsp;'.Yii::t('app', 'Promoviši uslugu'), ['/new-presentation'], [
                    'class'=>'btn btn-link btn-sm', 
                    'style'=>'padding:0;', 
                    'data'=>[
                        'method' => 'get',
                        'params'=>['ProviderServices[service_id]'=>$model->service_id],
                    ]
                ]) ?> | 
                <?= Html::a('<i class="fa fa-cog"></i>&nbsp;'.Yii::t('app', 'Podesi prezentaciju'), Url::to('/presentation-setup/'.$model->id), ['class'=>'btn btn-link btn-sm', 'style'=>'padding:0;']); ?>
            </div> 
        </div>
    </div>
    <div class="secondary-context cont avatar-padded">
        <p><?= $model->description ?></p>
        <p>Cena: <b><?= Yii::$app->formatter->asCurrency($model->price, $model->currency->code) ?></b></p>
        <p>Dostupno: <b>od <?= Yii::$app->formatter->asDate($model->valid_from) ?> - <?= Yii::$app->formatter->asDate($model->valid_through) ?></b></p>
    </div>
</div>