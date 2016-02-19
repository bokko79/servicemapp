<?php

use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use kartik\widgets\ActiveField;
use yii\helpers\ArrayHelper;
use kartik\widgets\DateTimePicker;
$formatter = \Yii::$app->formatter;
$time7 = Yii::$app->formatter->asDate(date('Y-m-d H:i:s', strtotime('+7 days')), "php:d-M-Y H:i");
$model->delivery_starts = $time7;
?>
<div class="wrapper headline" style="">
    <label class="head">
        <span class="badge"><?= $no ?></span>&nbsp;
        <i class="fa fa-calendar fa-lg"></i>&nbsp;
        <?php echo Yii::t('app', 'Kada?'); ?>
    </label>
    <i class="fa fa-chevron-right chevron"></i>
</div>
<div class="wrapper body fadeIn animated" style="border-top:none;">
    <p class="hint-text">Kada želite da pružalac usluge počne sa izvršavanjem usluge? <?= ($service->time==3) ? 'Do kada želite da završi' : '' ?><?= ($service->duration==3 || $service->duration==4) ? 'Koliko želite da traje?' : '' ?></p>
    <?php if($service->time==1): // time required ?>
        <div class="form-group">
            <?= Html::activeLabel($model, 'delivery_starts', ['label'=>'Početak izvršenja usluge', 'class'=>'col-sm-3 control-label']) ?>
            <div class="col-sm-5">
                <?= $form->field($model, 'delivery_starts', [
                        'showLabels' => false,
                        'feedbackIcon' => [
                            'success' => 'ok',
                            'error' => 'exclamation-sign',
                            'successOptions' => ['class'=>'text-primary'],
                            'errorOptions' => ['class'=>'text-primary']
                        ],
                    ])->widget(DateTimePicker::classname(), [
                            'language' => 'sr-Ln',
                            'size' => 'lg',
                            'pickerButton'=>['class'=>'', 'title'=>'Izaberite datum i vreme'],
                            'pluginOptions' => [                        
                                'autoclose' => true,
                                'todayHighlight' => true,
                                //'todayBtn' => true,                        
                                //'format' => 'd-M-yyyy h:ii',                        
                            ]
                    ]) ?>
            </div>
        </div>
    <?php elseif($service->time==3): // start + end ?>
        <?= $form->field($model, 'delivery_ends')->input('number') ?>
    <?php else: // time optional ?>

    <?php endif; ?>
    
    <?php /* $form->field($model, 'duration')->input('number') ?>
    <?= $form->field($model, 'duration_unit')->dropDownList([ 'sec' => 'sekundi', 'min' => 'minuta', 'hour' => 'časova', 'day' => 'dana', 'week' => 'sedmica', 'mnth' => 'meseci', 'year' => 'godina',], ['prompt' => '']) */ ?>
</div>