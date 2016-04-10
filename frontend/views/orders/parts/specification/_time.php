<?php

use yii\helpers\Html;
use kartik\widgets\ActiveField;
use yii\helpers\ArrayHelper;
use kartik\widgets\TimePicker;
use kartik\datecontrol\DateControl;

$model_spec->spec = $specification->default_value;
?>
<div class="form-group kv-fieldset-inline">
    <?= Html::activeLabel($model_spec, '['.$key.']spec', [
        'label'=>$property->label, 
        'class'=>'col-sm-3 control-label'
    ]); ?>
    <div class="col-sm-3" style="padding-right:0">
        <?= $form->field($model_spec, '['.$key.']spec',[
                'showLabels' => false,
                'feedbackIcon' => [
                    'success' => 'ok',
                    'error' => 'exclamation-sign',
                    'successOptions' => ['class'=>'text-primary', 'style'=>'padding-right:40%; top: 6px;'],
                    'errorOptions' => ['class'=>'text-primary', 'style'=>'padding-right:40%; top: 6px;']
                ],
            ])->widget(DateControl::classname(), [
                    'language' => 'rs-latin',
                    'type' => 'time',
                    'options'=> [
                        'size' => 'lg',
                        'pluginOptions' => [                        
                            'autoclose' => true,                   
                        ],
                    ],                                
            ]) ?>
    </div>        
</div>