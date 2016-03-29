<?php
use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use kartik\widgets\ActiveField;
use yii\helpers\ArrayHelper;
use kartik\switchinput\SwitchInput;

$model->consumer_min = $service->consumer_default;

$message = Yii::t('app', 'Da li imate ograničenja ispod/iznad kog broj korisnika ne vršite {service}?', ['service'=>$service->tName]);
?>
<div class="wrapper headline" style="" id="consumer">
    <label class="head">
        <span class="badge"><?= $model->noConsumer ?></span>&nbsp;
        <i class="fa fa-user fa-lg"></i>&nbsp;
        <?= Yii::t('app', 'Za koliko osoba?') ?>
    </label>
    <?= ($service->consumer==2) ? ' <span class="optional">(opciono)</span>' : '' ?>
    <i class="fa fa-chevron-down chevron"></i>
</div>

<div class="wrapper body fadeIn animated" style="border-top:none;" id="sections09">
<?= $this->render('../_hint.php', ['message'=>$message]) ?>
    <?= $form->field($model, 'consumerConstCheck', [
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
    <div class="form-group kv-fieldset-inline consumer-container" style="display:none;">
        <?= Html::activeLabel($model, 'consumer_min', [
            'label'=>'Minimalan broj korisnika', 
            'class'=>'col-sm-3 control-label'
        ]); ?>
        <div class="col-sm-3" style="padding:0">
            <?= $form->field($model, 'consumer_min',[
                    'addon' => [
                        'append' => ['content'=>'<i class="fa fa-user"></i>'],
                        'groupOptions' => ['class'=>'']
                    ],
                    'feedbackIcon' => [
                        'success' => 'ok',
                        'error' => 'exclamation-sign',
                        'successOptions' => ['class'=>'text-primary', 'style'=>'padding-right:25%'],
                        'errorOptions' => ['class'=>'text-primary', 'style'=>'padding-right:25%; top: 6px;'],
                    ],
                    'hintType' => ActiveField::HINT_SPECIAL,
                    'hintSettings' => ['onLabelClick' => true, 'onLabelHover' => false, 'title' => '<i class="glyphicon glyphicon-info-sign"></i> Napomena', ],
                    'showLabels'=>false
                ])->input('number', ['min'=>$service->consumer_range_min, 'max'=>$service->consumer_range_max, 'step'=>$service->consumer_range_step])->hint('') ?>
        </div>
        <div class="col-sm-4" style="padding-right:0">
            <?= $form->field($model, 'consumer_max',[
                    'addon' => [
                        'append' => ['content'=>'<i class="fa fa-user"></i>'],
                        'groupOptions' => ['class'=>'']
                    ],
                    'feedbackIcon' => [
                        'success' => 'ok',
                        'error' => 'exclamation-sign',
                        'successOptions' => ['class'=>'text-primary', 'style'=>'padding-right:25%'],
                        'errorOptions' => ['class'=>'text-primary', 'style'=>'padding-right:25%; top: 6px;'],
                    ],
                    'hintType' => ActiveField::HINT_SPECIAL,
                    'hintSettings' => ['onLabelClick' => true, 'onLabelHover' => false, 'title' => '<i class="glyphicon glyphicon-info-sign"></i> Napomena', ],
                ])->input('number', ['min'=>$service->consumer_range_min, 'max'=>$service->consumer_range_max, 'step'=>$service->consumer_range_step])->label('Maksimalan') ?>
        </div>

        
    </div>
<?= $this->render('_submitButton.php') ?>
</div>