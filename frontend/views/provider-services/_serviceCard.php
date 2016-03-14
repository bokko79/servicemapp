<?php
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\Modal;
?>
<div class="card_container record-full grid-item no-shadow top-bordered fadeIn animated" id="card_container" style="margin:0">
    <div class="header-context inverted collapsing" id="service<?= $model->id ?>">                
        <div class="avatar">
            <?= Html::img('@web/images/cards/info/info_docs'.rand(0,9).'.jpg') ?>         
        </div>
        <div class="title">
            <div class="head thin"><?= c($model->service->tName) ?></div>
            <div class="subhead">
                <?= Html::a('<i class="fa fa-bell"></i>&nbsp;'.Yii::t('app', 'Podesi obaveštenja'), Url::to('/my-service-setup/'.$model->id), ['class'=>'btn btn-link btn-sm', 'style'=>'padding:0;']); ?>
            </div> 
        </div>
        <div class="subaction">
            <?= Html::a('<i class="fa fa-times"></i>', Url::to(), ['class'=>'btn btn-link', 'style'=>'', 'data-toggle'=>'modal', 'data-backdrop'=>false, 'data-target'=>'#service-delete'.$model->id]); ?>
        </div>
    </div>
    <div class="secondary-context avatar-padded">
        <div class="head second">Prezentacije (<?= count($model->presentations) ?>)</div>
        <div class="subhead">
        <?php if($model->presentations!=null): ?>
            <?php if(!$model->service->object->models): ?>
            <?= Html::a('<i class="fa fa-plus-circle"></i>&nbsp;'.Yii::t('app', 'Napravi novu prezentaciju'), ['/new-presentation'], [
                'class'=>'btn btn-link btn-sm', 
                'style'=>'padding:0;', 
                'data'=>[
                    'method' => 'get',
                    'params'=>['ProviderServices[service_id]'=>$model->service_id, 'ProviderServices[id]'=>$model->id],
                ]
            ]) ?>
            <?php else: ?>
            <?= Html::a('<i class="fa fa-plus-circle"></i>&nbsp;'.Yii::t('app', 'Napravi novu prezentaciju'), Url::to(), ['class'=>'btn btn-link btn-sm', 'style'=>'padding:0;', 'data-toggle'=>'modal', 'data-backdrop'=>false, 'data-target'=>'#object-models'.$model->id]); ?>
            <?php endif; ?>
        <?php endif; ?>
        </div>
    </div>
    <div class="secondary-context cont avatar-padded" style="overflow:hidden;">
    <?php if($model->presentations){
            foreach ($model->presentations as $presentation){
                    echo $this->render('_presentationCard.php', ['model'=>$presentation]);
            }
        } else {
            $text = '<i class="fa fa-plus-circle fa-3x"></i>
                    <h4>Napravi novu prezentaciju usluge</h4>
                    <p>Omogućite klijentima i kupcima da naruče i plate  ' .$model->service->tName.' direktno od Vas.</p>';
            if(!$model->service->object->models): ?>
            <?= Html::a($text, ['/new-presentation'], [
                'class'=>'createProject fadeIn animated', 
                'style'=>'padding:20px;', 
                'data'=>[
                    'method' => 'get',
                    'params'=>['ProviderServices[service_id]'=>$model->service_id, 'ProviderServices[id]'=>$model->id],
                ]
            ]) ?>
            <?php else: ?>
            <?= Html::a($text, Url::to(), ['class'=>'createProject fadeIn animated', 'style'=>'padding:20px;', 'data-toggle'=>'modal', 'data-backdrop'=>false, 'data-target'=>'#object-models'.$model->id]); ?>
            <?php endif; ?>
            <?php } ?>
    </div>
</div>