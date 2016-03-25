<?php
use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use kartik\widgets\ActiveField;
use yii\helpers\ArrayHelper;

$model->consumer_min = $service->consumer_default;

$message = Yii::t('app', 'Za koliko osoba Vam treba {service}?', ['service'=>$service->tName]);
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
    <div class="form-group kv-fieldset-inline">
        <?= Html::activeLabel($model, 'consumer_min', [
            'label'=>'Broj korisnika', 
            'class'=>'col-sm-3 control-label'
        ]); ?>
        <div class="col-sm-3" style="padding-right:0">
            <?= $form->field($model, 'consumer_min',[
                    'addon' => [
                        'prepend' => ['content'=>'<i class="fa fa-user"></i>'],
                        'groupOptions' => ['class'=>'input-group-lg']
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
                ])->input('number', ['min'=>$service->consumer_range_min, 'max'=>$service->consumer_range_max, 'step'=>$service->consumer_range_step, 'placeholder'=>($service->consumer_children==0) ? '' : 'Broj odraslih'])->hint('Enter address in 4 lines. First 2 lines must contain the street details and next 2 lines the city, zip, and country detail.') ?>
        </div>

        
    </div>
<?= $this->render('_submitButton.php') ?>
</div>