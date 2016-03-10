<?php
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\Modal;
?>
<div class="card_container record-full grid-item no-shadow top-bordered fadeInUp animated" id="card_container" style="margin:0">
    <div class="header-context">                
        <div class="avatar">
            <?= Html::img('@web/images/cards/info/info_docs'.rand(0,9).'.jpg') ?>         
        </div>
        <div class="title">
            <div class="head thin"><?= c($model->service->tName) ?></div>
            <div class="subhead">
                <?php if(!$model->service->object->models): ?>
                <?= Html::a('<i class="fa fa-plus-circle"></i>&nbsp;'.Yii::t('app', 'Napravi novu prezentaciju'), ['/new-presentation'], [
                    'class'=>'btn btn-link btn-sm', 
                    'style'=>'padding:0;', 
                    'data'=>[
                        'method' => 'post',
                        'params'=>['Presentations[service_id]'=>$model->service_id],
                    ]
                ]) ?>
                <?php else: ?>
                <?= Html::a('<i class="fa fa-plus-circle"></i>&nbsp;'.Yii::t('app', 'Napravi novu prezentaciju'), Url::to(), ['class'=>'btn btn-link btn-sm', 'style'=>'padding:0;', 'data-toggle'=>'modal', 'data-backdrop'=>false, 'data-target'=>'#object-models'.$model->id]); ?>
                <?php endif; ?> | 
                <?= Html::a('<i class="fa fa-bell"></i>&nbsp;'.Yii::t('app', 'Podesi obaveštenja'), Url::to('/my-service-setup/'.$model->id), ['class'=>'btn btn-link btn-sm', 'style'=>'padding:0;']); ?>
            </div> 
        </div>
        <div class="subaction">
            <?= Html::a('<i class="fa fa-times"></i>', Url::to(), ['class'=>'btn btn-link', 'style'=>'', 'data-toggle'=>'modal', 'data-backdrop'=>false, 'data-target'=>'#service-delete'.$model->id]); ?>
        </div>
    </div>
</div>