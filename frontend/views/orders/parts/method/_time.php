<?php

use yii\helpers\Html;
use kartik\widgets\ActiveField;
use yii\helpers\ArrayHelper;
use kartik\widgets\TimePicker;
use kartik\datecontrol\DateControl;

$model_method->method = $method->default_value;
?>
<div class="form-group kv-fieldset-inline">
    <?= Html::activeLabel($model_method, '['.$key.']method', [
        'label'=>$property->label, 
        'class'=>'col-sm-3 control-label'
    ]); ?>
    <div class="col-sm-3" style="padding-right:0">
        <?= $form->field($model_method, '['.$key.']method', [
                'showLabels' => false,
            ])->widget(DateControl::classname(), [
                    'language' => 'rs-latin',
                    'type' => 'time',                    
                    'options'=> [                        
                        'size' => 'lg',
                        'pluginOptions' => [                        
                            'autoclose' => true,
                            'minuteStep' => $method->range_step,
                            'defaultTime' => $method->default_value,
                        ],
                    ],                                
            ]) ?>
    </div>        
</div>