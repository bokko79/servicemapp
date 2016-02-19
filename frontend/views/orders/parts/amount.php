<?php
use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use kartik\widgets\ActiveField;
use yii\helpers\ArrayHelper;
use kartik\builder\Form;
?>
<div class="wrapper headline" style="">
    <label class="head">
        <span class="badge"><?= $no ?></span>&nbsp;
        <i class="fa fa-signal fa-rotate-270 fa-lg"></i>&nbsp;
        <?= Yii::t('app', 'Koliko?') ?>
    </label>
    <?= ($service->amount==2) ? ' <span class="optional">(opciono)</span>' : '' ?>
    <i class="fa fa-chevron-right chevron"></i>
</div>

<div class="wrapper <?= ($service->amount==2) ? 'notshown' : '' ?> body fadeIn animated" style="border-top:none;">
<p class="hint-text"><?= Yii::t('app', 'Koliko {unit} Vam treba {service}?', ['unit'=>$service->unit->tNameGen, 'service'=>$service->tName]); ?></p>
    <?php if($service->amount==1): ?>
        <?= $form->field($model, 'amount', [
                    'addon' => [
                        'append' => ['content'=>$service->unit->oznaka],
                        //'groupOptions' => ['class'=>'input-group-lg'],
                    ],
                    'feedbackIcon' => [
                        'success' => 'ok',
                        'error' => 'exclamation-sign',
                        'successOptions' => ['class'=>'text-primary', 'style'=>'left:180px;'],
                        'errorOptions' => ['class'=>'text-primary', 'style'=>'left:180px;']
                    ]])->input('number', ['min'=>$service->amount_range_min, 'max'=>$service->amount_range_max, 'step'=>$service->amount_range_step, 'value'=>$service->amount_default, 'style' => '']) ?>

    <?php else: ?>
    <div class="form-group kv-fieldset-inline">
        <?= Html::activeLabel($model, 'amount', [
            'label'=>'Količina', 
            'class'=>'col-sm-3 control-label'
        ]); ?>
        <div class="col-sm-2" style="padding-right:0;">
            <?= $form->field($model, 'amount_operator', [
                'showLabels'=>false
            ])->dropDownList(['exact'=>'tačno', 'approx'=>'oko', 'min'=>'najmanje', 'max'=>'najviše'])->label(false) ?>
        </div>
        <div class="col-sm-4">
            <?= $form->field($model, 'amount', [
                    'showLabels'=>false,
            		'addon' => [
                        'append' => ['content'=>$service->unit->oznaka],
                        //'groupOptions' => ['class'=>'input-group-lg'],
                    ],
                    'feedbackIcon' => [
                        'success' => 'ok',
                        'error' => 'exclamation-sign',
                        'successOptions' => ['class'=>'text-primary', 'style'=>'left:180px;'],
                        'errorOptions' => ['class'=>'text-primary', 'style'=>'left:180px;']
                    ]])->input('number', ['min'=>$service->amount_range_min, 'max'=>$service->amount_range_max, 'step'=>$service->amount_range_step, 'value'=>$service->amount_default, 'style' => ''])->label(false) ?>
        </div>
    </div>
    <?php endif; ?>
</div>