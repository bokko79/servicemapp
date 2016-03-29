<?php
use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use kartik\widgets\ActiveField;
use yii\helpers\ArrayHelper;
use kartik\widgets\DateTimePicker;
use kartik\widgets\TimePicker;
use kartik\datecontrol\DateControl;
use kartik\switchinput\SwitchInput;

$daysOfWeekFull = [1=>'Ponedeljak', 2=>'Utorak', 3=>'Sreda', 4=>'Četvrtak', 5=>'Petak', 6=>'Subota', 7=>'Nedelja'];
?>
<div class="form-group kv-fieldset-inline" style="padding: 20px 0 10px; margin: 0; background: #ddd;">
    <?= Html::activeLabel($provider_openingHours[0], 'dayLabel', ['label'=>'Globalno', 'class'=>'col-sm-3 control-label']) ?>     
    <div class="col-sm-2">
    </div>
    <div class="col-sm-2">
        <?= $form->field($provider_openingHours[0], 'global_time_start', [
        		'enableAjaxValidation' => false,
                'showLabels' => false,
            ])->widget(DateControl::classname(), [
                    'language' => 'rs-latin',
                    'type' => 'time',
                    'options'=> [
                        'pluginOptions' => [                        
                            'autoclose' => true, 
                            'defaultTime' => '8:00',
                        ],
                    ],                                
            ]) ?>
    </div>
    <div class="col-sm-2">
        <?= $form->field($provider_openingHours[0], 'global_time_end', [
        		'enableAjaxValidation' => false,
        		'showLabels' => false,
            ])->widget(DateControl::classname(), [
                    'language' => 'rs-latin',
                    'type' => 'time',
                    'options'=> [
                        'pluginOptions' => [                        
                            'autoclose' => true,
                            'defaultTime' => '16:00',
                        ],
                    ],                                
            ]) ?>
    </div>
    <div class="col-sm-1"></div>
</div> 
<?php /* foreach($daysOfWeekFull as $key=>$dayOfWeek): ?>
<div class="form-group kv-fieldset-inline" style="padding: 10px 0 0; margin: 0; background: #e2e2e2;">
    <?= Html::activeLabel($provider_openingHours[$key], '['.$key.']dayLabel', ['label'=>$dayOfWeek, 'class'=>'col-sm-3 control-label']) ?>  
    <div class="col-sm-2">
    <?php $provider_openingHours[$key]->workingDay[$key] = true; ?>
        <?= $form->field($provider_openingHours[$key], '['.$key.']workingDay', [
        'hintType' => ActiveField::HINT_SPECIAL,
        'hintSettings' => ['onLabelClick' => true, 'onLabelHover' => false, 'title' => '<i class="glyphicon glyphicon-info-sign"></i> Pribor i oprema', ],
        ])->widget(SwitchInput::classname(), [
            'containerOptions'=>['style'=>'margin-left:0;'],
            'options'=> [
				'id'=>'ccc'.$key,
            ],
            'pluginOptions' => [
                'onText' => 'Da',
                'onColor' => 'info',
                'offText' => 'Ne',
            ]
        ])->label('Radni dan?') ?>
    </div>
    <div class="col-sm-2">
        <?= $form->field($provider_openingHours[$key], '['.$key.']open', [
        		'enableAjaxValidation' => false,
                'showLabels' => false,
            ])->widget(DateControl::classname(), [
                    'language' => 'rs-latin',
                    'type' => 'time',
                    'options'=> [
                    	'id'=>'aaa'.$key,
                        'pluginOptions' => [                        
                            'autoclose' => true,
                            'defaultTime' => false,               
                        ],
                    ],                                
            ]) ?>
    </div>
    <div class="col-sm-2">
        <?= $form->field($provider_openingHours[$key], '['.$key.']closed', [
        		'enableAjaxValidation' => false,
        		'showLabels' => false,
            ])->widget(DateControl::classname(), [
                    'language' => 'rs-latin',
                    'type' => 'time',
                    //'disabled' => true,
                    'options'=> [
                    	'id'=>'bbb'.$key,
                        'pluginOptions' => [                        
                            'autoclose' => true,
                            'defaultTime' => false,
                        ],
                    ],                                
            ]) ?>
    </div>
    <div class="col-sm-1"></div>
</div> 
<?= yii\helpers\Html::activeHiddenInput($provider_openingHours[$key], '['.$key.']day_of_week', ['value'=>$key]) ?>
<?php endforeach;*/ ?> 