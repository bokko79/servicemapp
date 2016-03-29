<?php
use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use kartik\widgets\ActiveField;
use yii\helpers\ArrayHelper;
use kartik\builder\Form;
use kartik\switchinput\SwitchInput;

$message = Yii::t('app', 'Da li imate ograničenja ispod/iznad kojih naručenih količina {unit} ne vršite {service}?', ['unit'=>$service->unit->tNameGen, 'service'=>$service->tName]);
?>
<div class="wrapper headline" style="" id="amount">
    <label class="head">
        <span class="badge"><?= $model->noAmount ?></span>&nbsp;
        <i class="fa fa-signal fa-rotate-270 fa-lg"></i>&nbsp;
        <?= Yii::t('app', 'Koliko {unit}?', ['unit'=>$service->unit->tNameGen,]) ?>
    </label>
    <?= ($service->amount==2) ? ' <span class="optional">(opciono)</span>' : '' ?>
    <i class="fa fa-chevron-down chevron"></i>
</div>
<div class="wrapper body fadeIn animated" style="border-top:none;" id="sections08">
    <?= $this->render('../_hint.php', ['message'=>$message]) ?>
    <?= $form->field($model, 'quantityConstCheck', [
                'hintType' => ActiveField::HINT_SPECIAL,
                'hintSettings' => ['onLabelClick' => true, 'onLabelHover' => false, 'title' => '<i class="glyphicon glyphicon-info-sign"></i> Pribor i oprema', ],
                ])->widget(SwitchInput::classname(), [
                    'containerOptions'=>['style'=>'margin-left:0;'],
                    'pluginOptions' => [
                        'onText' => 'Da',
                        'onColor' => 'info',
                        'offText' => 'Ne',
                        'size' => 'large',
                        'inlineLabel' => false,         
                    ]
                ])->hint('') ?>
    <div class="form-group kv-fieldset-inline quantity-container" style="display:none;">
        <?= Html::activeLabel($model, 'quantity_min', [
            'label'=>'Minimalna porudžbina', 
            'class'=>'col-sm-3 control-label'
        ]); ?>
        <div class="col-sm-3" style="padding:0">
            <?= $form->field($model, 'quantity_min',[
                    'addon' => [
                        'append' => ['content'=>$service->unit->oznaka],
                        'groupOptions' => ['class'=>'']],
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
        <div class="col-sm-4" style="padding-right:0">
            <?= $form->field($model, 'quantity_max',[
                    'addon' => [
                        'append' => ['content'=>$service->unit->oznaka],
                        'groupOptions' => ['class'=>'']],
                    'feedbackIcon' => [
                        'success' => 'ok',
                        'error' => 'exclamation-sign',
                        'successOptions' => ['class'=>'text-primary', 'style'=>'padding-right:60%'],
                        'errorOptions' => ['class'=>'text-primary', 'style'=>'padding-right:60%; top: 6px;']
                    ],
                    'hintType' => ActiveField::HINT_SPECIAL,
                    'hintSettings' => ['onLabelClick' => true, 'onLabelHover' => false, 'title' => '<i class="glyphicon glyphicon-info-sign"></i> Napomena', ],
                ])->input('number', ['min'=>$service->amount_range_min, 'max'=>$service->amount_range_max, 'step'=>$service->amount_range_step])->label('Maksimalna') ?>
        </div>     
    </div>
<?= $this->render('_submitButton.php') ?>
</div>