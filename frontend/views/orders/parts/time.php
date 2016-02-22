<?php

use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use kartik\widgets\ActiveField;
use yii\helpers\ArrayHelper;
use kartik\widgets\DateTimePicker;
use kartik\widgets\DatePicker;
use kartik\field\FieldRange;
use kartik\datecontrol\DateControl;

$time7 = Yii::$app->formatter->asDate(date('Y-m-d H:i:s', strtotime('+7 days')), "php:d M yy h:i");
//$model->delivery_starts = $time7;
$data = [0=>'Što je pre moguće', 1=>'<i class="fa fa-calendar-check-o"></i> Odredite tačan početak izvršenja usluga'];
$message = 'Kada želite da pružalac usluge počne sa izvršavanjem usluge? '. (($service->time==3) ? 'Do kada želite da završi? ' : '') . (($service->duration==3 || $service->duration==4) ? 'Koliko želite da traje?' : '');
?>
<div class="wrapper headline" style="">
    <label class="head">
        <span class="badge"><?= $no ?></span>&nbsp;
        <i class="fa fa-calendar fa-lg"></i>&nbsp;
        <?php echo Yii::t('app', 'Kada?'); ?>
    </label>
    <i class="fa fa-chevron-<?= ($service->time==2) ? 'right' : 'down' ?> chevron"></i>
</div>
<div class="wrapper <?= ($service->time==2) ? 'notshown' : '' ?> body fadeIn animated" style="border-top:none;">
    <?= $this->render('../_hint.php', ['message'=>$message]) ?>
    <?php if($service->time==1): // time required ?>
        <div class="form-group kv-fieldset-inline">
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
                    ])->widget(DateControl::classname(), [
                            'language' => 'sr-Ln',
                            'type' => 'datetime',
                            'options'=> [
                                'type'=>2,
                                'size' => 'lg',
                                'pickerButton'=>['title'=>'Izaberite datum i vreme'],
                                'pluginOptions' => [                        
                                    'autoclose' => true,
                                    'todayHighlight' => true,
                                    'startDate'=>date('Y-m-d H:i:s'),                      
                                ],
                            ],                                
                    ]) ?>
            </div>
        </div>
    <?php elseif($service->time==3): // start + end ?>
                 <?= FieldRange::widget([
                    'form' => $form,
                    'model' => $model,
                    'label' => 'Početak izvršenja usluge',
                    'attribute1' => 'delivery_starts',
                    'attribute2' => 'delivery_ends',
                    'type' => FieldRange::INPUT_WIDGET,
                    'widgetClass' => DateControl::classname(),
                    //'separator'=>'&larr; '.\Yii::t('app', 'od...do').' &rarr;',
                    'widgetOptions1' => [
                        'language' => 'sr-Ln', 
                        'options' => ['type'=>2, 'size'=>'lg', 'pluginOptions'=>['autoclose'=>true, 'todayHighlight' => true, 'startDate'=>'0d']],
                    ],
                    'widgetOptions2' => [
                        'language' => 'sr-Ln',
                        'options' => ['type'=>2, 'size'=>'lg', 'pluginOptions'=>['autoclose'=>true, 'todayHighlight' => true, 'startDate'=>'0d']],
                    ]
                ]) ?>  
    <?php else: // time optional ?>
        <div class="form-group">
            <div class="col-md-offset-3 col-md-9" style="">
                <?= $form->field($model, 'new_time')->radioButtonGroup($data)->label(false) ?>                
            </div>
        </div>
        <div class="form-group enter_time fadeIn animated" style="margin-top:30px; display:none;">            
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
                    ])->widget(DateControl::classname(), [
                            'language' => 'sr-Ln',
                            'type' => 'datetime',
                            'options'=> [
                                'type'=>2,
                                'size' => 'lg',
                                'pickerButton'=>['title'=>'Izaberite datum i vreme'],
                                'pluginOptions' => [                        
                                    'autoclose' => true,
                                    'todayHighlight' => true,
                                    'startDate'=>date('Y-m-d H:i:s'),                      
                                ],
                            ],                                
                    ]) ?>                    
            </div>            
        </div>        
    <?php endif; ?>
    
    <?php /* $form->field($model, 'duration')->input('number') ?>
    <?= $form->field($model, 'duration_unit')->dropDownList([ 'sec' => 'sekundi', 'min' => 'minuta', 'hour' => 'časova', 'day' => 'dana', 'week' => 'sedmica', 'mnth' => 'meseci', 'year' => 'godina',], ['prompt' => '']) */ ?>
</div>