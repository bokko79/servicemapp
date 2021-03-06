<?php
use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use kartik\widgets\ActiveField;
use yii\helpers\ArrayHelper;
use kartik\builder\Form;

$model->amount = $service->amount_default;

$message = Yii::t('app', 'Koliko {unit} Vam treba {service}?', ['unit'=>$service->unit->tNameGen, 'service'=>$service->tName]);
?>
<div class="wrapper headline" style="">
    <label class="head">
        <span class="badge"><?= $model->noAmount ?></span>&nbsp;
        <i class="fa fa-balance-scale fa-lg"></i>&nbsp;
        <?= Yii::t('app', 'Koliko {unit}?', ['unit'=>$service->unit->tNameGen,]) ?>
    </label>
    <?= ($service->amount==2) ? ' <span class="optional">(opciono)</span>' : '' ?>
    <i class="fa fa-chevron-<?= ($service->amount==2) ? 'right' : 'down' ?> chevron"></i>
</div>
<div class="wrapper <?= ($service->amount==2) ? 'notshown' : '' ?> body fadeIn animated" style="border-top:none;">
    <?= $this->render('../_hint.php', ['message'=>$message]) ?>
    <div class="form-group kv-fieldset-inline">
        <?= Html::activeLabel($model, 'amount', [
            'label'=>'Količina', 
            'class'=>'col-sm-3 control-label'
        ]); ?>
        <?php if($service->amount==2): ?>
        <div class="col-sm-2" style="padding-right:0">
            <?= $form->field($model, 'amount_operator',[
                    'showLabels'=>false
                ])->dropDownList(['exact'=>'=', 'approx'=>'oko', 'min'=>'min', 'max'=>'max'], ['class'=>'input-lg']) ?>
        </div>
        <?php endif; ?>
        <div class="col-sm-3" style="padding-right:0">
            <?= $form->field($model, 'amount',[
                    'addon' => [
                        'append' => ['content'=>$service->unit->oznaka],
                        'groupOptions' => ['class'=>'input-group-lg']],
                    'feedbackIcon' => [
                        'success' => 'ok',
                        'error' => 'exclamation-sign',
                        'successOptions' => ['class'=>'text-primary', 'style'=>'padding-right:60%'],
                        'errorOptions' => ['class'=>'text-primary', 'style'=>'padding-right:60%; top: 6px;']
                    ],
                    'hintType' => ActiveField::HINT_SPECIAL,
                    'hintSettings' => ['onLabelClick' => true, 'onLabelHover' => false, 'title' => '<i class="glyphicon glyphicon-info-sign"></i> Napomena', ],
                    'showLabels'=>false
                ])->input('number', ['min'=>$service->amount_range_min, 'max'=>$service->amount_range_max, 'step'=>$service->amount_range_step]); ?>
        </div>        
    </div>
</div>