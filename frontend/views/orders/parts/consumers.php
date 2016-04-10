<?php
use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use kartik\widgets\ActiveField;
use yii\helpers\ArrayHelper;

$model->consumer = $service->consumer_default;
$model->consumer_children = ($service->consumer_children==1) ? 0 : null;

$message = Yii::t('app', 'Za koliko osoba Vam treba {service}?', ['service'=>$service->tName]);
?>
<div class="wrapper headline" style="">
    <label class="head">
        <span class="badge"><?= $model->noConsumer ?></span>&nbsp;
        <i class="fa fa-user fa-lg"></i>&nbsp;
        <?= Yii::t('app', 'Za koliko osoba?') ?>
    </label>
    <?= ($service->consumer==2) ? ' <span class="optional">(opciono)</span>' : '' ?>
    <i class="fa fa-chevron-<?= ($service->consumer==2) ? 'right' : 'down' ?> chevron"></i>
</div>

<div class="wrapper <?= ($service->consumer==2) ? 'notshown' : '' ?> body fadeIn animated" style="border-top:none;">
<?= $this->render('../_hint.php', ['message'=>$message]) ?>
    <div class="form-group kv-fieldset-inline">
        <?= Html::activeLabel($model, 'consumer', [
            'label'=>'Broj korisnika', 
            'class'=>'col-sm-3 control-label'
        ]); ?>
        <?php if($service->consumer==2): ?>
        <div class="col-sm-2" style="padding-right:0">
            <?= $form->field($model, 'consumer_operator',[
                    'showLabels'=>false
                ])->dropDownList(['exact'=>'=', 'approx'=>'oko', 'min'=>'min', 'max'=>'max'], ['class'=>'input-lg']) ?>
        </div>
        <?php endif; ?>
        <div class="col-sm-3" style="padding-right:0">
            <?= $form->field($model, 'consumer',[
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
                ])->input('number', ['value'=>$service->consumer_range_min, 'min'=>$service->consumer_range_min, 'max'=>$service->consumer_range_max, 'step'=>$service->consumer_range_step, 'placeholder'=>($service->consumer_children==0) ? '' : 'Broj odraslih'])->hint('Enter address in 4 lines. First 2 lines must contain the street details and next 2 lines the city, zip, and country detail.') ?>
        </div>

        <?php if($service->consumer!=0 && $service->consumer_children!=0): ?>
        <div class="col-sm-3" style="padding-right:0">
            <?= $form->field($model, 'consumer_children',[
                    'addon' => [
                        'prepend' => ['content'=>'<i class="fa fa-child"></i>'],
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
                ])->input('number', ['min'=>0, 'placeholder'=>'Broj dece'])->hint('Enter address in 4 lines. First 2 lines must contain the street details and next 2 lines the city, zip, and country detail.') ?>
        </div>
        <?php endif; ?>
    </div>
</div>