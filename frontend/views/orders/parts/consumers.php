<?php
use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use kartik\widgets\ActiveField;
use yii\helpers\ArrayHelper;

?>
<div class="wrapper headline" style="">
    <label class="head">
        <span class="badge"><?= $no ?></span>&nbsp;
        <i class="fa fa-user fa-lg"></i>&nbsp;
        <?= Yii::t('app', 'Za koliko osoba?') ?>
    </label>
    <?= ($service->consumer==2) ? ' <span class="optional">(opciono)</span>' : '' ?>
    <i class="fa fa-chevron-right chevron"></i>
</div>

<div class="wrapper <?= ($service->consumer==2) ? 'notshown' : '' ?> body fadeIn animated" style="border-top:none;">
<p class="hint-text"><?= Yii::t('app', 'Za koliko osoba Vam treba {service}?', ['service'=>$service->tName]) ?></p>
    <?php if($service->consumer==1): ?>
    <?= $form->field($model, 'consumer', [
        	'hintType' => ActiveField::HINT_SPECIAL,
			'hintSettings' => ['onLabelClick' => true, 'onLabelHover' => false, 'title' => '<i class="glyphicon glyphicon-info-sign"></i> Napomena', ],
            'feedbackIcon' => [
                'default' => 'user',
                'success' => 'ok',
                'error' => 'exclamation-sign',
                'defaultOptions' => ['class'=>'text-primary']
            ]])->input('number', ['min'=>$service->consumer_range_min, 'max'=>$service->consumer_range_max, 'step'=>$service->consumer_range_step, 'value'=>$service->consumer_default])->hint('Enter address in 4 lines. First 2 lines must contain the street details and next 2 lines the city, zip, and country detail.') ?>

    

    <?php if($service->consumer_children!=0): ?>
        <?= $form->field($model, 'consumer_children', [
                'feedbackIcon' => [
                    'success' => 'ok',
                    'error' => 'exclamation-sign',
                    'defaultOptions' => ['class'=>'text-primary']
                ]])->input('number', ['min'=>0]) ?>
    <?php endif; ?>
    
    <?php else: ?>
    <div class="form-group kv-fieldset-inline">
        <?= Html::activeLabel($model, 'consumer', [
            'label'=>'Broj korisnika', 
            'class'=>'col-sm-3 control-label'
        ]); ?>
        <div class="col-sm-2" style="padding-right:0;">
            <?= $form->field($model, 'consumer_operator', [
                'showLabels'=>false
            ])->dropDownList(['exact'=>'tačno', 'approx'=>'oko', 'min'=>'najmanje', 'max'=>'najviše'])->label(false) ?>
        </div>
        <div class="col-sm-4">
            <?= $form->field($model, 'consumer', [
                    'showLabels'=>false,
                    'hintType' => ActiveField::HINT_SPECIAL,
                    'hintSettings' => ['onLabelClick' => true, 'onLabelHover' => false, 'title' => '<i class="glyphicon glyphicon-info-sign"></i> Napomena', ],
                    'feedbackIcon' => [
                        'default' => 'user',
                        'success' => 'ok',
                        'error' => 'exclamation-sign',
                        'defaultOptions' => ['class'=>'text-primary']
                    ]])->input('number', ['min'=>$service->consumer_range_min, 'max'=>$service->consumer_range_max, 'step'=>$service->consumer_range_step, 'value'=>$service->consumer_default])->hint('Enter address in 4 lines. First 2 lines must contain the street details and next 2 lines the city, zip, and country detail.')->label(false) ?>
        </div>
    </div>
    <?php endif; ?>
</div>